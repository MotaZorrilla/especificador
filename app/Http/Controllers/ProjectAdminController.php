<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Filedata;
use Barryvdh\DomPDF\Facade\Pdf;

class ProjectAdminController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {      
        $projects = Project::orderBy('id','desc')->paginate();

        return view('dashboard.projectAdmin.projectAdmin-index', compact('projects'));
    }

    //Show the form for creating a new resource.
    public function create()
    {
        return view('dashboard.projectAdmin.projectAdmin-create');
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

        return redirect()->route('projectAdmin.show', $project );
    }

    //Display the specified resource.
    public function show(Project $projectAdmin)
    {
        
        $filedata = Filedata::where('masividad', $projectAdmin->masividad)
                            ->get();

        
    
        

        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin','filedata'));
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
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projectAdmin.index');
    }

    public function pdf(Project $project)
    {   
        
        $filedata = Filedata::where('masividad', $project->masividad )
        //  ->where('m90', '!=', 'Fuera de rango')
        // ->latest('id')
        // ->take(4)
        ->get();

        // return view('dashboard.project.project-pdf', compact('project', 'filedata'));
        $pdf   = PDF::loadView('dashboard.projectAdmin.projectAdmin-pdf', compact('project', 'filedata'));

        return $pdf->download('Especificador de pintura Administrador.pdf');
    }

    public function updateProjectAdmin(Request $request, Project $projectAdmin)
    {
        // Actualiza los datos del proyecto
        $projectAdmin->observaciones = $request->observaciones;

        $projectAdmin->save();

        $filedata = Filedata::where('masividad', $projectAdmin->masividad)
                            ->get();
        
        // Redirige al usuario a la página de edición del proyecto
        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin','filedata'));
    }


}
