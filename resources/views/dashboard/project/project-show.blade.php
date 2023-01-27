@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <h3>Proyecto {{ $project->nombre }}</h3>
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
                            <div>
                                <h3>{{ $project->nombre }}</h3>
                            </div>
                            <div class="form-group">
                                <label for="project_data" class="form-control-label">Descripción:</label>
                                <p>{{ $project->descripcion }}</p> 
                            </div>
                            <div class="form-group">
                                <label for="mass" class="form-control-label">Tipo Perfil:</label>
                                <p>{{ $project->perfil }}</p>
                            </div>
                            <div class="form-group">
                                <label for="mass" class="form-control-label">Masividad:</label>
                                <p>{{ $project->masividad }}</p>
                            </div>
                            <div class="form-group">
                                <label for="mass" class="form-control-label">Resistencia al Fuego:</label>
                                <p>{{ $project->resistencia }}</p>
                            </div>
                            <div>
                                <div class="d-flex ">
                                    <form action="{{ route('project.edit', $project) }}" method="get" >
                                        <button type="submit" class="btn bg-gradient-info m-1">Editar</button>
                                    </form>
                                    <form action="{{ route('project.destroy', $project) }}" method="post" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn bg-gradient-danger m-1">Eliminar</button>
                                    </form>
                                    <form action="{{ route('project.index') }}" method="get" >
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
