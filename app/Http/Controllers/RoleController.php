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
        $request->validate([
            'name'      =>  'required|unique:roles'
        ]);

        $role = Role::create( $request->all());

        return redirect()->route('role.edit', $role)
                ->with('success', 'El role se actualizó con éxito');
    }

    public function show(Role $role)
    {
        return view('dashboard.role.role-show',compact('role'));
    }

    public function edit(Role $role)
    {
        return view('dashboard.role.role-edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'      =>  "required|unique:roles,name,$role->id"
        ]);

        $role->update($request->all());

        return redirect()->route('role.edit', $role)
                ->with('success', 'El role se actualizó con éxito');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('role.index')
                ->with('success', 'El role se eliminó con éxito');
    }
}
