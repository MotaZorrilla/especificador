@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos | Administradores | Mostrar'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <h3>Proyecto {{ $projectAdmin->nombre }}</h3>
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
                        <div class="container py-5 col-5">   
                            <form action="{{ route('updateProjectAdmin', $projectAdmin) }}" method="post" >
                                @csrf
                                @method('put')
                                @if (Session::has('message'))
                                    <p>{{ Session::get('messsage')}}</p>
                                @endif  
                                <div>
                                    <h3>{{ $projectAdmin->nombre }}</h3>
                                </div>
                                <div class="form-group">
                                    <label for="project_data" class="form-control-label">Descripción:</label>
                                    <p>{{ $projectAdmin->descripcion }}</p> 
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Tipo Perfil:</label>
                                    <p>{{ $projectAdmin->perfil }} {{ $projectAdmin->forma ? "con $projectAdmin->forma" : '' }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Masividad:</label>
                                    <p>{{ $projectAdmin->masividad }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Resistencia al Fuego:</label>
                                    <p>{{ $projectAdmin->resistencia }}</p>
                                </div>
                                <div>
                                    <table class="table align-items-center mb-0 table-striped" cellpadding="10">
                                        <thead>
                                            <tr>
                                                <th>Pintura</th>
                                                <th>Modelo</th>
                                                <th>Certificado</th>
                                                <th>Numero</th>
                                                <th>Espesor mínimo<br> recomendado</th>
                                                <th>Incluir</th>
                                        </thead>
                                        <tbody>
                                            @foreach($filedata as $filedatum)
                                                <tr>
                                                    <td>{{ $filedatum->pintura }}</td> 
                                                    <td>{{ $filedatum->modelo }}</td> 
                                                    <td class="text-center">{{ $filedatum->certificado }}</td>
                                                    <td class="text-center">{{ $filedatum->numero }}</td>
                                                    @if ($projectAdmin->resistencia == 15)
                                                        <td class="text-center">{{ $filedatum->m15 }}</td>
                                                    @elseif ($projectAdmin->resistencia == 30)
                                                        <td class="text-center">{{ $filedatum->m30 }}</td>
                                                    @elseif ($projectAdmin->resistencia == 60)
                                                        <td class="text-center">{{ $filedatum->m60 }}</td>
                                                    @elseif ($projectAdmin->resistencia == 90)
                                                        <td class="text-center">{{ $filedatum->m90 }}</td>
                                                    @elseif ($projectAdmin->resistencia == 120)
                                                        <td class="text-center">{{ $filedatum->m120 }}</td>
                                                    @endif
                                                    <td class="text-center"><input type="checkbox" name="seleccionados[]" value="{{ $filedatum->id }}" checked=""></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="observaciones">Observaciones:</label>
                                    <textarea class="form-control" id="observaciones" name="observaciones"
                                    @if (empty($projectAdmin->observaciones))
                                        placeholder="Escribe las observaciones de tu Proyecto"></textarea>
                                    @else
                                        >{{ $projectAdmin->observaciones }}</textarea>
                                    @endif
                                    
                                    
                                </div>
                                <div class="d-flex ">
                                    <div>
                                        <button type="submit" class="btn bg-gradient-info m-1">Actualizar</button>
                                    </div>
                            </form>
                                <div>
                                    <div class="d-flex ">
                                        <form action="{{ route('projectAdmin.edit', $projectAdmin) }}" method="get" >
                                            <button type="submit" class="btn bg-gradient-success m-1">Editar</button>
                                        </form>
                                        <form action="{{ route('projectAdmin.destroy', $projectAdmin) }}" method="post" >
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn bg-gradient-danger m-1">Eliminar</button>
                                        </form>
                                        <form action="{{ route('projectAdmin.index') }}" method="get" >
                                            <button type="submit" class="btn bg-gradient-success m-1">Volver</button>
                                        </form> 
                                        <form action="{{ route('projectAdmin.pdf', $projectAdmin ) }}" method="get" >
                                            <button type="submit" class="btn bg-gradient-danger m-1">Ver PDF</button>
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
