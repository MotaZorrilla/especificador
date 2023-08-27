@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Base de Datos'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <h3>Proyecto {{ $filedatum->nombre }}</h3>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0"> 
                                <tbody> 
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
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
                        <div class="container py-3 col-6">   
                            <div>
                                <h3>{{ $filedatum->pintura }}</h3>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Pintura:</label>
                                        <p>{{ $filedatum->pintura }}</p> 
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Modelo:</label>
                                        <p>{{ $filedatum->modelo }}</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Certificado:</label>
                                        <p>{{ $filedatum->certificado }}</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Numero de certificado:</label>
                                        <p>{{ $filedatum->numero }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Masividad:</label>
                                        <p>{{ $filedatum->masividad }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="mass" class="form-control-label">15 minutos:</label>
                                        <p>{{ $filedatum->m15 }}</p>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="mass" class="form-control-label">30 minutos:</label>
                                        <p>{{ $filedatum->m30 }}</p>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="mass" class="form-control-label">60 minutos:</label>
                                        <p>{{ $filedatum->m60 }}</p>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="mass" class="form-control-label">90 minutos:</label>
                                        <p>{{ $filedatum->m90 }}</p>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="mass" class="form-control-label">120 minutos:</label>
                                        <p>{{ $filedatum->m120 }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="mass" class="form-control-label">Pilar 4 caras:</label>
                                        <p>{{ $filedatum->p4c }}</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="mass" class="form-control-label">Viga 4 caras:</label>
                                        <p>{{ $filedatum->v4c }}</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="mass" class="form-control-label">Viga 3 caras:</label>
                                        <p>{{ $filedatum->v3c }}</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="d-flex ">
                                    <form action="{{ route('filedata.edit', $filedatum) }}" method="get" >
                                        <button type="submit" class="btn bg-gradient-info m-1">Editar</button>
                                      </form>
                                      <form action="{{ route('filedata.destroy', $filedatum) }}" method="post" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn bg-gradient-danger m-1">Eliminar</button>
                                      </form> 
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
@endsection
