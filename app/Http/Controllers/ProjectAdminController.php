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
        $project->forma         = $request->forma;
        $project->resistencia   = $request->resistencia;
        $project->masividad     = $request->masividad;
        $project->altura        = $request->dato_H;
        $project->base1         = $request->dato_B1;
        $project->base2         = $request->dato_B2;
        $project->espesor1      = $request->dato_e1;
        $project->espesor2      = $request->dato_e2;
        $project->espesort      = $request->dato_et;
        $project->radio         = $request->dato_r;
        $project->plieque       = $request->dato_C;
        $project->diametro      = $request->dato_D;
        $project->observaciones = $request->observaciones;       

        $project->save();

        return redirect()->route('projectAdmin.show', $project );
    }

    //Display the specified resource.
    public function show(Project $projectAdmin)
    {   
        $filedata = [];

        if ($projectAdmin->forma == "Perfil Rectangular") {
        $dato_H     =   $projectAdmin->altura;
        $dato_B1    =   $projectAdmin->base1;
        $dato_e1    =   $projectAdmin->espesor1;
        $dato_r     =   $projectAdmin->espesor1;

        $dato_A     =   2*$dato_B1*$dato_e1+2*$dato_H*$dato_e1-16*$dato_e1*$dato_e1+3*pi()*$dato_e1*$dato_e1;
        $dato_P     =   2*$dato_B1+2*$dato_H-16*$dato_e1+4*pi()*$dato_e1;
        $masividad  =   ceil(1000*$dato_P/$dato_A);

        if ($masividad <= 0) {
            return redirect()->back()->withErrors(['masividad' => 'El cálculo de la masividad no puede resultar en un número negativo o cero.']);
        }
        

        // asegurarse de que la masividad sea positiva
        $masividad = max($masividad, 0);

        $projectAdmin->masividad = $masividad;
        $projectAdmin->save();
        }

        // cargar los datos de la tabla $filedata
        $filedata = Filedata::where('masividad', $projectAdmin->masividad)->get(); 

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

        $filedata = Filedata::where('masividad', $projectAdmin->masividad)
                            ->get();
        
        // Redirige al usuario a la página de edición del proyecto
        return view('dashboard.projectAdmin.projectAdmin-show', compact('projectAdmin','filedata'));
    }


}
