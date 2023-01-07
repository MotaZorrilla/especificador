<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Maatwebsite\Excel\Facades\Excel ;
use App\Exports\FilesExport;
use App\Imports\Filesimport;
use App\Models\User;

use function Ramsey\Uuid\v1;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.files');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import(Request $request)
    {
        $file = $request->file('file');
        Excel::import(new FilesImport, $file);
        
        return back()->with('message', 'Importación de la tablas de Pintura Completada');
    }

    public function export()
    {
        return Excel::download(new FilesExport,'tabla-pintura.xlsx');   
    }

    public function excel()
    {
        $files = File::get();
        return view('pages.excel')->with('files', $files);
    }
}
