<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserDevice;
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
            $sessionDeviceToken = $request->session()->get('device_token');

            // Si por alguna razón la sesión actual no tiene token, generar uno y asociarlo
            if (!$sessionDeviceToken) {
                $sessionDeviceToken = (string) Str::uuid();
                $request->session()->put('device_token', $sessionDeviceToken);
            }

            // Buscar el dispositivo activo más reciente del usuario
            $activeDevice = UserDevice::where('user_id', $user->id)
                ->where('is_active', true)
                ->latest()
                ->first();

            if ($activeDevice) {
                // Si existe un dispositivo activo y su token NO coincide con la sesión actual: Kicking
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

                // Actualizar timestamp de actividad (throttled a cada minuto)
                if (!$activeDevice->last_activity_at || $activeDevice->last_activity_at->diffInMinutes(now()) >= 1) {
                    $activeDevice->update(['last_activity_at' => now()]);
                }
            } else {
                // Si no hay dispositivo activo registrado, registrar el actual
                UserDevice::create([
                    'user_id' => $user->id,
                    'session_id' => $request->session()->getId(),
                    'device_token' => $sessionDeviceToken,
                    'device_name' => $this->detectDeviceName($request->userAgent()),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'is_active' => true,
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
        } elseif (str_contains($userAgent, 'Safari')) {
            $browser = 'Safari';
        } elseif (str_contains($userAgent, 'Firefox')) {
            $browser = 'Firefox';
        }

        return "{$os} / {$browser}";
    }
}
