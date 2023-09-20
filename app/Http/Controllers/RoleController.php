<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('dashboard.role.role-index');
    }

    public function create()
    {
        return view('dashboard.role.role-create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Role $role)
    {
        return view('dashboard.role.role-show',compact($role));
    }

    public function edit(Role $role)
    {
        return view('dashboard.role.role-edit',compact($role));
    }

    public function update(Request $request, Role $role)
    {
        //
    }

    public function destroy(Role $role)
    {
        //
    }
}
