<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user');
    }
    
    public function index()
    {
        // $users = User::paginate();
        
        return view('dashboard.user.user-index'); 
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {   
        $roles = Role::all();

        return view('dashboard.user.user-edit', compact('user','roles'));
    }

    public function update(Request $request,User $user)
    {   
        $user->roles()->sync($request->role);

        return redirect()->route('user.edit',$user)
                ->with('success', 'El usuario se actualizó con éxito');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
                ->with('success', 'El usuario se eliminó con éxito');
    }

}
