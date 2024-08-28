<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Filedata;
use Barryvdh\DomPDF\Facade\Pdf;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:project');
    }

    // Display a listing of the resource.
    public function index()
    {
        return view('dashboard.project.project-index');
    }

    //Show the form for creating a new resource.
    public function create()
    {
        $user = auth()->user();

        return view('dashboard.project.project-create', compact('user'));
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $project = new Project();

        // Asociar el proyecto al usuario actual
        $project->user()->associate(auth()->user());
        $project->user_project_counter = Project::where('user_id', auth()->user())->max('user_project_counter') + 1;
        $project->project       = $request->project;
        $project->description   = $request->description;
        $project->save();

        // Redirigir a la página de proyectos con un mensaje de éxito
        return redirect()->route('project.index')->with('success', '¡Proyecto creado con éxito!');
    }

    //Display the specified resource.
    public function show($project)
    {
        return view('dashboard.projectProfile.profile-index', compact('project'));
    }

    //Show the form for editing the specified resource.
    public function edit(Project $project)
    {
        return view('dashboard.project.project-edit', compact('project'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, Project $project)
    {
        $project->observaciones = $request->observaciones;

        $project->save();

        $filedata = Filedata::where('masividad', ceil($project->masividad))
            ->get();

        // Redirige al usuario a la página de edición del proyecto
        return view('dashboard.projectAdmin.projectAdmin-show', compact('project', 'filedata'));
    }

    //Remove the specified resource from storage.
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('project.index')->with('success', 'El proyecto se eliminó con éxito');
    }
}
