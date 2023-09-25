<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:plan');
    }

    public function index()
    {
        return view('dashboard.plan.plan-index');
    }

    public function create()
    {
        return view('dashboard.plan.plan-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  'required|unique:plans',
            'perfiles'  =>  'required',
            'price'     =>  'required' 
        ]);

        $plan = Plan::create( $request->all());

        return redirect()->route('plan.edit', $plan)
                ->with('success', 'El plan se actualizó con éxito');
    }

    public function show(Plan $plan)
    {
        return view('dashboard.plan.plan-show',compact('plan'));
    }

    public function edit(Plan $plan)
    {
        return view('dashboard.plan.plan-edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'name'      =>  "required|unique:plans,name,$plan->id",
            'perfiles'  =>  'required',
            'price'     =>  'required' 
        ]);

        $plan->update($request->all());

        return redirect()->route('plan.edit', $plan)
                ->with('success', 'El plan se actualizó con éxito');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()->route('plan.index')
                ->with('success', 'El plan se eliminó con éxito');
    }
}
