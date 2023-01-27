<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {      
        $projects = Project::orderBy('id','desc')->paginate();

        return view('dashboard.project.project-index', compact('projects'));
    }

    //Show the form for creating a new resource.
    public function create()
    {
        return view('dashboard.project.project-create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $project = new Project();

        $project->nombre        = $request->nombre;
        $project->descripcion   = $request->descripcion;
        $project->perfil        = $request->perfil;
        $project->masividad     = $request->masividad;
        $project->resistencia   = $request->resistencia;

        $project->save();

        return redirect()->route('project.show', $project );
    }

    //Display the specified resource.
    public function show(Project $project)
    {
        return view('dashboard.project.project-show', compact('project'));
    }

    //Show the form for editing the specified resource.
    public function edit(Project $project)
    {
        return view('dashboard.project.project-edit', compact('project'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, Project $project)
    {
        $project->nombre        = $request->nombre;
        $project->descripcion   = $request->descripcion;
        $project->perfil        = $request->perfil;
        $project->masividad     = $request->masividad;
        $project->resistencia   = $request->resistencia;

        $project->save();

        return view('dashboard.project.project-show', compact('project'));
    }

    //Remove the specified resource from storage.
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('project.index');
    }
}
