<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
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

        $project->nombre        = $request->nombre;
        $project->descripcion   = $request->descripcion;
        $project->exposicion    = $request->exposicion;
        $project->perfil        = $request->perfil;
        $project->forma         = $request->forma;
        
        $project->masividad     = $request->masividad;
        $project->resistencia   = $request->resistencia;
        
        $project->altura        = ($request->dato_H); 
        $project->base1         = ($request->dato_B1);
        $project->base2         = ($request->dato_B2);
        $project->espesor1      = ($request->dato_e1);
        $project->espesor2      = ($request->dato_e2);
        $project->espesort      = ($request->dato_t);
        $project->radio         = ($request->dato_r);
        $project->plieque       = ($request->dato_C);
        $project->diametro      = ($request->dato_D);
        
        $project->observaciones = $request->observaciones;       
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

        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin','filedata'));
    }

    //Remove the specified resource from storage.
    public function destroy(Project $projectAdmin)
    {
        $projectAdmin->delete();

        return redirect()->route('projectAdmin.index')->with('success', 'El proyecto se eliminó con éxito');
    }

    public function pdf(Project $projectAdmin)
    {   
        
        $filedata = Filedata::where('masividad', $projectAdmin->masividad )
        //  ->where('m90', '!=', 'Fuera de rango')
        // ->latest('id')
        // ->take(4)
        ->get();

        // return view('dashboard.project.project-pdf', compact('project', 'filedata'));
        $pdf   = PDF::loadView('dashboard.projectAdmin.projectAdmin-pdf', compact('projectAdmin', 'filedata'));

        return $pdf->download('Especificador de pintura Administrador.pdf');
    }

    public function updateProjectAdmin(Request $request, Project $projectAdmin)
    {
        // Actualiza los datos del proyecto
        $projectAdmin->observaciones = $request->observaciones;

        $projectAdmin->save();

        $filedata = Filedata::where('masividad', ceil($projectAdmin->masividad))
                            ->get();
        
        // Redirige al usuario a la página de edición del proyecto
        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin','filedata'));
    }

    // public function profile()
    // {
    //     $user = auth()->user();

    //     $projects = project::all();

    //     return view('dashboard.projectAdmin.projectAdminProfile-create', compact('user','projects'));
    // }
}
