<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plan;
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
        $plans = Plan::all();

        return view('dashboard.user.user-edit', compact('user', 'roles', 'plans'));
    }

    public function update(Request $request, User $user)
    {
        // Actualizar roles
        $user->roles()->sync($request->new_role);

        // Obtener el nuevo plan seleccionado
        $newPlanId = $request->new_plan;

        // Verificar si se ha seleccionado un nuevo plan
        if ($newPlanId) {
            // Asignar el nuevo plan al usuario
            $user->plans()->sync([$newPlanId]);

            // Obtener el plan para obtener el profile_count
            $newPlan = Plan::find($newPlanId);

            // Incrementar el contador de perfiles según el nuevo plan
            $user->profile_count += $newPlan->profile_count;
            $user->save();
        }

        return redirect()->route('user.edit', $user)
            ->with('success', 'El usuario se actualizó con éxito');
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'El usuario se eliminó con éxito');
    }
}
