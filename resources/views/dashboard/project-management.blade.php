@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Proyectos</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0"> 
                                <tbody>
                                    
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/img/icons/export.png" class="avatar avatar-sm me-3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Crear Nuevo Proyecto</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-right text-sm">
                                            <a class="badge badge bg-gradient-secondary" href="{{route('project.create')}}">Crear</a>
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
                    <div class="card-header pb-0">
                        <h6>Proyectos Creados</h6>
                    </div>
                    <div class="card-body px-3 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table  class="table table-striped " id="project">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            ID
                                        </th>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Nombre del Proyecto
                                        </th>                                        
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Tipo de Perfil
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Masividad
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Resistencia al fuego
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Actualizado
                                        </th> 
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Acción
                                        </th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                    <tr>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $project->id }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $project->nombre }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $project->perfil }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $project->masividad }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $project->resistencia }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $project->updated_at ? $project->updated_at->diffForHumans() : '' }}</p>
                                        </td>
                                        <td class="align-middle ">                                           
                                            <div class="d-flex ">
                                                <button type="button" class="btn bg-gradient-info m-1">Editar</button>
                                                <button type="button" class="btn bg-gradient-danger m-1">Borrar</button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
