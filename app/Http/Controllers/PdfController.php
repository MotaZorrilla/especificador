<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Filedata;
use App\Models\Project;

class PdfController extends Controller
{   
    //imprimir pdf
    public function create($id)
    
    {   
       
        $project = Project::where('id', $id)->get();
        return $project;
        $filedata = Filedata::where('id', $project->id)->get();
        // $filedata = Filedata::where('masividad', $project->masividad )
        // ->where('m90', '!=', 'fuera de rango')
        // ->latest('id')
        // ->take(4)
        // ->get();
        return $filedata;
	
	return view('pages.pdf', compact('project', 'filedata'));

        if (!$project) {
            return response()->json(['error' => 'No se ha encontrado la instancia de Project.'], 404);
        }
        
        dd($project);
        
        
        return $project;

        return view('pages.pdf', compact('project', 'filedata'));
        // $filedata = Filedata::where('masividad', $request)->get();   
        // return view('pages.pdf', compact('filedata'));
        // $filedata = Filedata::where('masividad', )->get();  
        // return redirect()->route('page.pdf', $filedata );

        // $pdf   = PDF::loadView('pages.pdf', compact('filedata')); 

        // return $pdf->download('pages.pdf');
    return view("pages.pdf");
    }
}
