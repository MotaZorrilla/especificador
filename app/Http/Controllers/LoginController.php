<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function redirect()
    {
        return 	Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $userGoogle = Socialite::driver('google')->user(); 
        
 
        $user = User::updateOrCreate([
            'google_id'     => $userGoogle->id,
        ], [
            'username'      => $userGoogle->name,
            'email'         => $userGoogle->email,
            /*'google_token' => $userGoogle->token,
            'google_refresh_token' => $userGoogle->refreshToken,*/
        ]);
    
        Auth::login($user);
    
        return redirect('/dashboard');
    }

}
