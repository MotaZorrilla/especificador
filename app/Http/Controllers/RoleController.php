<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:role');
    }

    public function index()
    {
        return view('dashboard.role.role-index');
    }

    public function create()
    {
        $permissions = Permission::all();

        return view('dashboard.role.role-create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  'required|unique:roles',
            'permissions' => 'array',
        ]);

        $role = Role::create($request->all());

        $role->permissions()->sync($request->permissions);

        return redirect()->route('role.edit', $role)
            ->with('success', 'El role se creó con éxito');
    }

    public function show(Role $role)
    {
        return view('dashboard.role.role-show', compact('role'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('dashboard.role.role-edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'      =>  "required|unique:roles,name,$role->id",
            'permissions' => 'array',
        ]);

        $role->update($request->all());

        $role->permissions()->sync($request->permissions);

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
