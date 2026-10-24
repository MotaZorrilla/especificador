<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserDevice;
use App\Services\DeviceLicenseGuardService;
use Illuminate\Support\Str;

class SingleDeviceSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // 1. Validar Huella Física / Simulador de Dispositivo (1 Licencia = 1 Máquina)
            $guard = app(DeviceLicenseGuardService::class);
            $fingerprint = $guard->resolveDeviceFingerprint($request);

            if ($fingerprint !== null) {
                $verification = $guard->verifyOrBindFingerprint($user, $fingerprint, $request->ip());
                if (!$verification['allowed']) {
                    if ($request->expectsJson() || $request->hasHeader('X-Device-Fingerprint')) {
                        return response()->json($verification, 403);
                    }

                    return response()->view('errors.device-locked', $verification, 403);
                }
            }

            // 2. Validar Sesión Activa Única (Browser Kicking)
            $sessionDeviceToken = $request->session()->get('device_token');

            if (!$sessionDeviceToken) {
                $sessionDeviceToken = (string) Str::uuid();
                $request->session()->put('device_token', $sessionDeviceToken);
            }

            $activeDevice = UserDevice::where('user_id', $user->id)
                ->where('is_active', true)
                ->latest()
                ->first();

            if ($activeDevice) {
                if ($activeDevice->device_token !== $sessionDeviceToken) {
                    $deviceName = $activeDevice->device_name ?: 'Nuevo dispositivo';
                    $ip = $activeDevice->ip_address ?: 'IP externa';

                    Auth::logout();
                    $request->session()->invalidate();
                    $request->session()->regenerateToken();

                    return redirect()->route('login')->withErrors([
                        'device' => "Tu sesión ha sido finalizada porque se inició sesión desde otro equipo ({$deviceName} - {$ip}). Recuerda que tu licencia técnica permite un único puesto de trabajo activo simultáneamente.",
                    ]);
                }

                if (!$activeDevice->last_activity_at || $activeDevice->last_activity_at->diffInMinutes(now()) >= 1) {
                    $activeDevice->update([
                        'last_activity_at' => now(),
                        'device_fingerprint' => $fingerprint ?? $activeDevice->device_fingerprint,
                    ]);
                }
            } else {
                UserDevice::create([
                    'user_id' => $user->id,
                    'session_id' => $request->session()->getId(),
                    'device_token' => $sessionDeviceToken,
                    'device_fingerprint' => $fingerprint,
                    'device_name' => $this->detectDeviceName($request->userAgent()),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'is_active' => true,
                    'is_trusted_hardware' => true,
                    'last_activity_at' => now(),
                ]);
            }
        }

        return $next($request);
    }

    /**
     * Resumen amigable del navegador y sistema operativo
     */
    public static function detectDeviceName(?string $userAgent): string
    {
        if (!$userAgent) {
            return 'Estación de Trabajo Desconocida';
        }

        $os = 'Dispositivo Desconocido';
        if (str_contains($userAgent, 'Windows')) {
            $os = 'Windows PC';
        } elseif (str_contains($userAgent, 'Macintosh') || str_contains($userAgent, 'Mac OS')) {
            $os = 'Mac OS';
        } elseif (str_contains($userAgent, 'Linux')) {
            $os = 'Linux PC';
        } elseif (str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad')) {
            $os = 'iOS';
        } elseif (str_contains($userAgent, 'Android')) {
            $os = 'Android';
        }

        $browser = 'Navegador Web';
        if (str_contains($userAgent, 'Edg')) {
            $browser = 'Microsoft Edge';
        } elseif (str_contains($userAgent, 'Chrome')) {
            $browser = 'Google Chrome';
        } elseif (str_contains($userAgent, 'Firefox')) {
            $browser = 'Firefox';
        } elseif (str_contains($userAgent, 'Safari')) {
            $browser = 'Safari';
        }

        return "{$os} / {$browser}";
    }
}
