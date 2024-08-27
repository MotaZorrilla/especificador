<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Profile;
use App\Models\Result;
use App\Models\Filedata;
use Barryvdh\DomPDF\Facade\Pdf;
use Psy\Readline\Hoa\Console;

class ProjectAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:projectAdmin');
    }

    // Display a listing of the resource.
    public function index()
    {
        return view('dashboard.projectAdmin.projectAdmin-index');
    }

    //Show the form for creating a new resource.
    public function create()
    {
        $user = auth()->user();

        return view('dashboard.projectAdmin.projectAdmin-create', compact('user'));
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
        return redirect()->route('projectAdmin.index')->with('success', '¡Proyecto creado con éxito!');
    }

    //Display the specified resource.
    public function show($project)
    {
        return view('dashboard.projectProfile.profile-index', compact('project'));
    }


    //Show the form for editing the specified resource.
    public function edit(Project $projectAdmin)
    {
        return view('dashboard.projectAdmin.projectAdmin-edit', compact('projectAdmin'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, Project $projectAdmin)
    {
        $projectAdmin->nombre        = $request->nombre;
        $projectAdmin->descripcion   = $request->descripcion;
        $projectAdmin->perfil        = $request->perfil;
        $projectAdmin->masividad     = $request->masividad;
        $projectAdmin->resistencia   = $request->resistencia;

        $projectAdmin->save();

        $filedata = Filedata::where('masividad', $projectAdmin->masividad)
            ->get();

        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin', 'filedata'));
    }

    //Remove the specified resource from storage.
    public function destroy(Project $projectAdmin)
    {
        $projectAdmin->delete();

        return redirect()->route('projectAdmin.index')->with('success', 'El proyecto se eliminó con éxito');
    }

    public function pdf(Project $projectAdmin)
    {
        // Load additional relationships
        $project = $projectAdmin->load('user', 'profiles.results');

        // Filter profiles based on the 'incluir' attribute
        $profiles = $projectAdmin->profiles->filter(function ($profile) {
            return $profile->incluir;
        });

        // Set the timezone to America/Santiago
        date_default_timezone_set('America/Santiago');
        $date = date('d-m-Y H:i');

        // Load the view with necessary variables
        $pdf = PDF::loadView('dashboard.projectAdmin.projectAdmin-pdf', compact('project', 'profiles', 'date'));

        $pdf->setPaper('letter');

        // Stream the PDF to the browser
        $response = $pdf->stream();

        // Set headers for the PDF response
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'inline; filename=Especificador de Pintura Intumescente.pdf');

        return $response;
    }


    public function updateProjectAdmin(Request $request, Project $projectAdmin)
    {
        // Actualiza los datos del proyecto
        $projectAdmin->observaciones = $request->observaciones;

        $projectAdmin->save();

        $filedata = Filedata::where('masividad', ceil($projectAdmin->masividad))
            ->get();

        // Redirige al usuario a la página de edición del proyecto
        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin', 'filedata'));
    }
}
