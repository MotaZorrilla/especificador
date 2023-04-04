@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
@endsection

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
                                        <td class="align-middle text-center">
                                            <form action="{{ route('filedata.Import')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @if (Session::has('message'))
                                                <p>{{ Session::get('messsage')}}</p>
                                                @endif
                                                <button type="submit" class="btn bg-gradient-success m-1">Importar</button>
                                                <input type="file" name="filedata" accept=".xlsx">
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <a href="{{route('filedata.Export')}}"><img src="/img/icons/export.png" class="avatar avatar-sm me-3"></a>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Exportar Tablas</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center ">
                                            <form action="{{route('filedata.Export')}}" method="get" >
                                                <button type="submit" class="btn bg-gradient-info m-1">Exportar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <a href="{{route('filedata.create')}}"><img src="/img/icons/export.png" class="avatar avatar-sm me-3"></a>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Crear Nuevo Registro</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center ">
                                            <form action="{{route('filedata.create')}}" method="get" >
                                                <button type="submit" class="btn bg-gradient-info m-1">Crear</button>
                                            </form>
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
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0"> 
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <h6>Registros de Pinturas Intumescentes</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center col-3">
                                            <div class="ms-md-auto pe-md-3 d-flex align-items-center ">
                                                <div class="input-group">
                                                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                                    <input type="text" class="form-control" id= "search" placeholder="Buscar...">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                                            Actualizado
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Acción
                                        </th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filedata as $filedatum)
                                    <tr>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->id }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->pintura }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->modelo }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->certificado }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->numero }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->masividad }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->m15 }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->m30 }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->m60 }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->m90 }}</p>
                                        </td>
                                        <td class="align-middle text-sm">
                                            <p class="text-sm font-weight-bold mb-0">{{ $filedatum->updated_at ? $filedatum->updated_at->diffForHumans() : '' }}</p>
                                        </td>
                                        <td class="align-middle ">                                           
                                            <div class="d-flex ">
                                                <form action="{{ route('filedata.show', $filedatum) }}" method="get" >
                                                    <button type="submit" class="btn bg-gradient-info m-1">Ver Registro</button>
                                                </form>
                                                <form action="{{ route('filedata.destroy', $filedatum) }}" method="post" >
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn bg-gradient-danger m-1">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $filedata->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.footer')
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <script>
        var file = ['10000', '20000', 'hector'];
        $('#search').autocomplete({
            source: file
        });
    </script>
@endsection