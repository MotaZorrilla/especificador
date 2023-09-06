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
        $filedata = Filedata::orderBy('id', 'asc')
                    ->distinct('pintura')
                    ->pluck('pintura');
        
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
        
        return back();
    }

    public function export()
    {
        return Excel::download(new FiledataExport,'Registros_de_Pinturas.xlsx');   
    }

    public function order()
    {
        // Obtener los nombres de las pinturas sin repetir registros por pintura.
         $filedata = Filedata::orderBy('id', 'asc')
                    ->distinct('pintura')
                    ->pluck('pintura');

        return view('dashboard.filedata.filedata-editTable', compact('filedata')); 
    }

    public function orderList(Request $request)
    {
        // Validar la solicitud y obtener los datos del formulario
        $request->validate([
            'orden' => 'required|array',
        ]);
    
        // Obtener el nuevo orden desde la solicitud
        $orden = $request->input('orden');

        // Obtener los nombres de las pinturas sin repetir registros por pintura.
        $marcasPinturas = Filedata::orderBy('id', 'asc')
                        ->distinct('pintura')
                        ->pluck('pintura')
                        ->toArray(); // Convertir a un array para poder reordenarlo        

        // Crear un array asociativo que mapea el orden actual de las pinturas
        $ordenActual = array_flip($marcasPinturas);
        foreach ($ordenActual as &$ordenItem){
            $ordenItem+=1;
        }

        // Reorganizar el array de nombres de pinturas según el nuevo orden
        $marcasPinturasOrdenadas = [];
        foreach ($orden as $index => $ordenItem) {
            $marcaPintura = array_search($ordenItem, $ordenActual);
            $marcasPinturasOrdenadas[$index] = $marcaPintura;
        }
        // $marcasPinturasOrdenadas ahora contiene los nombres de las pinturas ordenados según el nuevo orden
            
        // Obtener todas la tabla
        $filedata = Filedata::all(); // tabla de base de datos
        Filedata::truncate();
    
        // Actualizar el orden de las marcas de pintura en función del nuevo orden
        foreach ( $marcasPinturasOrdenadas as $pintura ) {
            // Obtener la marca de pintura correspondiente desde la colección de $marcasPintura
            $modelos = $filedata->where('pintura', $pintura );

            foreach ( $modelos as $request){

            $filedatum = new Filedata();

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
            }
        }
        
        $filedata = Filedata::orderBy('id', 'asc')
                    ->distinct('pintura')
                    ->pluck('pintura');
        
                    dump($filedata);

        return view('dashboard.filedata.filedata-index', compact('filedata')); 
    }
    
    public function reset()
    {
        $filedata =Filedata::truncate();
            
        return view('dashboard.filedata.filedata-index', compact('filedata')); 
    }

}