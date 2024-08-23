<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\models\User;

class UserProfileController extends Controller
{
    public function update(Request $request)
    {
        $attributes = $request->validate([
            'username'  => ['required','max:255', 'min:2'],
            'firstname' => ['max:100'],
            'lastname'  => ['max:100'],
            'email'     => ['required', 'email', 'max:255',  Rule::unique('users')->ignore(auth()->user()->id),],
            'address'   => ['max:100'],
            'city'      => ['max:100'],
            'country'   => ['max:100'],
            'phone'    => ['max:100'],
            'about'     => ['max:255']
        ]);

        auth()->user()->update([
            'username'  => $request->get('username'),
            'firstname' => $request->get('firstname'),
            'lastname'  => $request->get('lastname'),
            'email'     => $request->get('email') ,
            'address'   => $request->get('address'),
            'city'      => $request->get('city'),
            'country'   => $request->get('country'),
            'phone'    => $request->get('phone'),
            'about'     => $request->get('about')
        ]);
        return back()->with('succes', 'Perfil Actualizado');
    }

    
    public function profile()
    {
        $user = Auth::user();
        $role = $user->roles->first()->name;

        return view("pages.profile-static",compact('user','role'));
    }
}
