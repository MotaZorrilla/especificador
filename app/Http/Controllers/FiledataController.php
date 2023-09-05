<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filedata;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FiledataImport;
use App\Exports\FiledataExport;

class FiledataController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $filedata = Filedata::orderBy('id','desc')->paginate();
        
        return view('dashboard.filedata.filedata-index', compact('filedata')); 
    }

    // Show the form for creating a new resource.
    public function create()
    {
        return view('dashboard.filedata.filedata-create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $filedatum = new filedata();

        $filedatum->pintura      = $request->pintura;
        $filedatum->modelo       = $request->modelo;
        $filedatum->certificado  = $request->certificado;
        $filedatum->numero       = $request->numero;
        $filedatum->masividad    = $request->masividad;
        $filedatum->m15          = $request->m15;
        $filedatum->m30          = $request->m30;
        $filedatum->m60          = $request->m60;
        $filedatum->m90          = $request->m90;
        $filedatum->m120         = $request->m120;
        $filedatum->p4c          = $request->p4c;
        $filedatum->v4c          = $request->v4c;
        $filedatum->v3c          = $request->v3c;
        $filedatum->abierta      = $request->abierta;
        $filedatum->rectangular  = $request->rectangular;
        $filedatum->circular     = $request->circular;

        $filedatum->save();

        return redirect()->route('filedata.show', $filedatum );
    }

    //Display the specified resource.
    public function show(Filedata $filedatum)
    {
        return view('dashboard.filedata.filedata-show', compact('filedatum'));
    }

    //Show the form for editing the specified resource.
    public function edit(Filedata $filedatum)
    {
        return view('dashboard.filedata.filedata-edit', compact('filedatum'));
    }

    //Update the specified resource in storage.
    public function update(Request $request, Filedata $filedatum)
    {
        $filedatum->pintura      = $request->pintura;
        $filedatum->modelo       = $request->modelo;
        $filedatum->certificado  = $request->certificado;
        $filedatum->numero       = $request->numero;
        $filedatum->masividad    = $request->masividad;
        $filedatum->m15          = $request->m15;
        $filedatum->m30          = $request->m30;
        $filedatum->m60          = $request->m60;
        $filedatum->m90          = $request->m90;
        $filedatum->m120         = $request->m120;
        $filedatum->p4c          = $request->p4c;
        $filedatum->v4c          = $request->v4c;
        $filedatum->v3c          = $request->v3c;
        $filedatum->abierta      = $request->abierta;
        $filedatum->rectangular  = $request->rectangular;
        $filedatum->circular     = $request->circular;


        $filedatum->save();

        return view('dashboard.filedata.filedata-show', compact('filedatum'));
    }

    //Remove the specified resource from storage.
    public function destroy(Filedata $filedatum)
    {
        $filedatum->delete();

        return redirect()->route('filedata.index');
    }

    public function import(Request $request)
    {
        $filedata = $request->file('filedata');

        Excel::import(new FiledataImport, $filedata);
        
        return back()->with('message', 'Importación de la tablas de Pintura Completada');
    }

    public function export()
    {
        return Excel::download(new FiledataExport,'Registros_de_Pinturas.xlsx');   
    }

    public function order()
    {
        // Obtener los registros ordenados por 'pintura' de manera ascendente y sin duplicados.
        $filedata = Filedata::orderBy('pintura', 'asc')->distinct('pintura')->paginate();

        return view('dashboard.filedata.filedata-index', compact('filedata')); 
    }


    public function reset()
    {
        Filedata::truncate();

        $filedata = Filedata::paginate();
            
        return view('dashboard.filedata.filedata-index', compact('filedata')); 
    }

}