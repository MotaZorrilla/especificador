<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filedata;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FiledataImport;
use App\Exports\FiledataExport;

class FiledataController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:filedata');
    }

    // Display a listing of the resource.
    public function index()
    {        
        return view('dashboard.filedata.filedata-index'); 
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

        return redirect()->route('filedata.index')->with('success', 'El registro se eliminó con éxito');
    }

    public function import(Request $request)
    {
        $filedata = $request->file('filedata');

        Excel::import(new FiledataImport, $filedata);
        
        return redirect()->route('filedata.index');
    }

    public function export()
    {
        return Excel::download(new FiledataExport,'Registros_de_Pinturas.xlsx');   
    }

    public function order()
    {
        // Obtener la lista única de pinturas en orden de aparición.
        $pinturas = Filedata::select('pintura')
            ->orderBy('orden', 'asc')
            ->pluck('pintura')
            ->unique()
            ->values();

        // Recorrer cada pintura única y asignar un número correlativo.
        foreach ($pinturas as $key => $pintura) {
        // El orden será la posición + 1 (para que empiece en 1).
        $orden = $key + 1;

        // Actualizar todos los registros con el nombre de pintura actual.
        Filedata::where('pintura', $pintura)->update(['orden' => $orden]);
        }

        return view('dashboard.filedata.filedata-editTable', compact('pinturas')); 
    }

    public function orderList(Request $request)
    {
        // Validar la solicitud: se espera un arreglo 'orden' con claves (marca de pintura) y valores (nuevo orden)
        $request->validate([
            'orden' => 'required|array',
        ]);

        // Obtener el arreglo de nuevos órdenes
        // Ejemplo: ['Pintura A' => 1, 'Pintura B' => 2, 'Pintura C' => 3, ...]
        $nuevosOrdenes = $request->input('orden');

        // Actualizar el campo 'orden' de cada registro que tenga la marca de pintura correspondiente
        foreach ($nuevosOrdenes as $pintura => $orden) {
            // Se puede incluir una validación adicional para asegurarse que $orden es un número válido (por ejemplo, >=1)
            Filedata::where('pintura', $pintura)->update(['orden' => $orden]);
        }

        // Redirigir o retornar la vista con un mensaje de éxito
        return redirect()->route('filedata.index')->with('mensaje', 'El orden se ha actualizado correctamente.');
    }

    
    public function reset()
    {
        $filedata =Filedata::truncate();
            
        return view('dashboard.filedata.filedata-index', compact('filedata')); 
    }

}