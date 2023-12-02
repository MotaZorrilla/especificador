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

        $project->nombre        = $request->nombre;
        $project->descripcion   = $request->descripcion;
        $project->perfil        = $request->perfil;
        $project->masividad     = $request->masividad;
        $project->resistencia   = $request->resistencia;

        $project->save();

        return redirect()->route('project.show', $project);
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

    public function pdf(Project $project)
    {
        dd($project);
        $filedata = Filedata::where('masividad', $project->masividad)
            //  ->where('m90', '!=', 'Fuera de rango')
            // ->latest('id')
            // ->take(4)
            ->get();

        // return view('dashboard.project.project-pdf', compact('project', 'filedata'));
        
        $pdf   = PDF::loadView('dashboard.project.project-pdf', compact('project', 'filedata'));

        return $pdf->download('Especificador de pintura.pdf');
    }
}
