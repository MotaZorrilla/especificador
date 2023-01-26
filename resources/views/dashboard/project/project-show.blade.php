@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="container">
                        <div class="card-header pb-0">
                            <h2>{{ $project->nombre }}</h2>
                        </div>  
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">  
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container py-5 col-5">   
                            <div>
                                <h3>Proyecto {{ $project->nombre }}</h3>
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
                                        @csrf
                                        <button type="submit" class="btn bg-gradient-info m-1">Editar</button>
                                    </form>
                                    <form action="{{ route('project.destroy', $project) }}" method="post" >
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn bg-gradient-danger m-1">Eliminar</button>
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
