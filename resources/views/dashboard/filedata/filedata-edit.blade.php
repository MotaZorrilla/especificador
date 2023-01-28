@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Base de Datos'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Base de Datos</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0"> 
                                <tbody> 
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Crear Nuevo registro</h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">  
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container py-5 col-5">   
                            <form action="{{ route('filedata.store')}}" method="post" >
                                @csrf
                                @if (Session::has('message'))
                                    <p>{{ Session::get('messsage')}}</p>
                                @endif
                                <div>
                                    <h3>Crear un Nuevo Registro</h3>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>Nombre de la Pintura:</label>
                                            <input class="form-control" type="text" id="pintura" name="pintura" value={{ $filedatum->pintura }}>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>Modelo:</label>
                                            <input class="form-control" type="text" id="modelo" name="modelo" value={{ $filedatum->modelo }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>Certificado:</label>
                                            <input class="form-control" type="text" id="certificado" name="certificado" value={{ $filedatum->certificado }}>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>Numero:</label>
                                            <input class="form-control" type="text" id="numero" name="numero" value={{ $filedatum->numero }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>Masividad:</label>
                                            <input class="form-control" type="text" id="masividad" name="masividad" value={{ $filedatum->masividad }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>15 minutos:</label>
                                            <input class="form-control" type="text" id="m15" name="m15" value={{ $filedatum->m15 }}>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>30 minutos:</label>
                                            <input class="form-control" type="text" id="m30" name="m30" value={{ $filedatum->m30 }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>60 minutos:</label>
                                            <input class="form-control" type="text" id="m60" name="m60" value={{ $filedatum->m60 }}>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>90 minutos:</label>
                                            <input class="form-control" type="text" id="m90" name="m90" value={{ $filedatum->m90 }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex ">
                                    <div>
                                        <button type="submit" class="btn bg-gradient-info m-1">Actualizar</button>
                                    </div>
                            </form>
                                    <div>
                                        <form action="{{ route('filedata.destroy', $filedatum) }}" method="post" >
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn bg-gradient-danger m-1">Eliminar</button>
                                        </form> 
                                    </div> 
                                    <div>
                                        <form action="{{ route('filedata.index') }}" method="get" >
                                            <button type="submit" class="btn bg-gradient-success m-1">Volver</button>
                                        </form> 
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
@endsection


