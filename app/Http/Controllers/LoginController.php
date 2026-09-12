<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\UserDevice;
use App\Http\Middleware\SingleDeviceSession;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            $this->registerActiveDevice($request, Auth::user());

            $intended = $request->session()->pull('url.intended');

            if ($intended) {
                $appUrl = rtrim(config('app.url', ''), '/');
                $appPath = parse_url($appUrl, PHP_URL_PATH) ?: '';
                $intendedPath = parse_url($intended, PHP_URL_PATH) ?: '/';

                // If intended path doesn't start with the app prefix (e.g. /especificador), add it
                if ($appPath && !str_starts_with($intendedPath, $appPath)) {
                    $intendedPath = $appPath . '/' . ltrim($intendedPath, '/');
                }

                // If intended target is root, app root, or login, go to home
                if (in_array($intendedPath, ['/', $appPath, $appPath . '/', $appPath . '/login'])) {
                    return redirect()->route('home');
                }

                return redirect()->to($intendedPath);
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'password' => 'Las credentiales no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $deviceToken = $request->session()->get('device_token');
            if ($deviceToken) {
                UserDevice::where('user_id', Auth::id())
                    ->where('device_token', $deviceToken)
                    ->update(['is_active' => false]);
            }
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function redirect()
    {
        return 	Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        $userGoogle = Socialite::driver('google')->stateless()->user(); 
        
 
        $user = User::updateOrCreate([
            'google_id'     => $userGoogle->id,
        ], [
            'username'      => $userGoogle->name,
            'email'         => $userGoogle->email,
        ]);
    
        Auth::login($user);
        $this->registerActiveDevice($request, $user);
    
        return redirect()->route('home');
    }

    /**
     * Registra el dispositivo actual como único activo, revocando cualquier sesión anterior (Seat Kicking)
     */
    protected function registerActiveDevice(Request $request, User $user): void
    {
        $deviceToken = (string) Str::uuid();
        $request->session()->put('device_token', $deviceToken);

        // Revocar sesiones activas previas
        UserDevice::where('user_id', $user->id)
            ->where('is_active', true)
            ->update(['is_active' => false]);

        // Registrar nueva sesión
        UserDevice::create([
            'user_id' => $user->id,
            'session_id' => $request->session()->getId(),
            'device_token' => $deviceToken,
            'device_name' => SingleDeviceSession::detectDeviceName($request->userAgent()),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'is_active' => true,
            'last_activity_at' => now(),
        ]);
    }
}

