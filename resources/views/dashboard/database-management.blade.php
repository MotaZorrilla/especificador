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
                                                <div>
                                                    <img src="/img/icons/import.png" class="avatar avatar-sm me-3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Importar Tablas</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('fileImport')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @if (Session::has('message'))
                                                <p>{{ Session::get('messsage')}}</p>
                                                @endif
                                                <button class="badge badge-sm bg-gradient-success" type="submit">Importar</button>
                                                <input type="file" name="file" accept=".xlsx">
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <a href="{{route('fileExport')}}"><img src="/img/icons/export.png" class="avatar avatar-sm me-3"></a>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Exportar Tablas</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-right ">
                                            <a class="badge badge bg-gradient-info" href="{{route('fileExport')}}">Exportar</a>
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
                        <h6>Registros de Pinturas Intumescentes</h6>
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
                                            Pintura 
                                        </th>                                        
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Modelo
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Certificado
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Numero
                                        </th> 
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Masividad
                                        </th> 
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            15m
                                        </th> 
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            30m
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            60m
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            90m
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            120m
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Pilar 4C
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Viga 4C
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Abierta
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Rectangular
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Circular
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
                                    @foreach ($files as $file)
                                    <tr>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->id }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->pintura }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->modelo }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->certificado }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->numero }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->masividad }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->m15 }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->m30 }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->m60 }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->m90 }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->m120 }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->p4c }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->v4c }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->v3c }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->abierta }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->rectangular }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->circular }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $file->updated_at ? $file->updated_at->diffForHumans() : '' }}</p>
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
                            {{ $files->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection