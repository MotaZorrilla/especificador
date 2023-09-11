@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">
    <style>
        .resaltado {
            background-color: yellow;
            font-weight: bold;
        }
    </style>

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
                                                <button style="width: 150px;"  type="submit" class="btn bg-gradient-success m-1">Importar</button>
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
                                                <button style="width: 150px;" type="submit" class="btn bg-gradient-info m-1">Exportar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <a href="{{route('filedata.create')}}"><img src="/img/icons/crear.png" class="avatar avatar-sm me-3"></a>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Crear Nuevo Registro</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center ">
                                            <form action="{{route('filedata.create')}}" method="get" >
                                                <button style="width: 150px;" type="submit" class="btn bg-gradient-info m-1">Crear</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <a href=#><img src="/img/icons/ordenar.png" class="avatar avatar-sm me-3"></a>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Ordenar base de datos de Pinturas</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center ">
                                            <form action="{{route('filedata.Order')}}" method="Post" >
                                                @csrf
                                                <button style="width: 150px;" id="btnOrdenarBD" type="submit" class="btn bg-gradient-info m-1">Ordenar BD</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <a href=#><img src="/img/icons/borrar-archivo.png" class="avatar avatar-sm me-3"></a>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Borrar base de datos de Pinturas</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center ">
                                            <button style="width: 150px;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#borrarBase">
                                                Borrar BD
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="borrarBase" tabindex="-1" aria-labelledby="borrarBaseLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-gradient-danger ">
                                                            <h1 class="modal-title fs-5 text-white" id="ModalLabel">Confirmar Borrado de Base de Datos</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-left">
                                                            <p>¿Estás seguro de que deseas borrar todos los registros <br>de la Base de datos?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="form" data-bs-target="#borrarForm" id="confirmarBorrar" 
                                                            onclick="event.preventDefault(); document.getElementById('borrarForm').submit();">
                                                                Borrar BD
                                                            </button>
                                                            <form id="borrarForm" action="{{ route('filedata.Reset') }}" method="POST" >
                                                                @csrf
                                                            </form>
                                                        </div>
                                                    </div>
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
                        <div class="table-responsive p-0 col-8 mx-auto" >
                            <table class="table align-items-center mb-0" style="overflow-x: auto;  table-layout: auto;"> 
                                <tbody >
                                    <tr >
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <h6>Registros de Pinturas Intumescentes</h6>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center col-3 ">
                                            <div class="ms-md-auto pe-md-3 d-flex align-items-center mx-5">
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
                    <div class="card-body px-3 pt-0 pb-2 col-6 align-middle mx-auto ">
                        <div class="table-responsive p-0" >
                            <table  class="table table-striped " style="overflow-x: auto; table-layout: auto;" id="project">
                                <thead>
                                    <tr>
                                        
                                        <th class="text-uppercase text-secondary col-2 font-weight-bolder mx-auto  opacity-7 ps-2">
                                            Posición 
                                        </th>    
                                        <th
                                            class="text-uppercase text-secondary font-weight-bolder text-left opacity-7 ps-2">
                                            Marca de Pintura
                                        </th>
                                        {{-- <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                            Acción
                                        </th>   --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($filedata->count() === 0)
                                        <tr>
                                            <td colspan="2">
                                                <div class="alert alert-warning">
                                                    No hay datos disponibles.
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @foreach ($filedata as $filedatum => $brand)
                                    <tr>
                                        
                                        <td class="align-middle mx-auto ">
                                            <p class="font-weight-bold mb-0">{{ $filedatum+1 }}</p>
                                        </td>
                                        
                                        <td class="align-middle">
                                            <p class="font-weight-bold mb-0">{{ $brand }}</p>
                                        </td>
                                        {{-- <td class="align-middle text-center">                                           
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
                                        </td> --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

      
    <script>
        // Datos de ejemplo para la búsqueda
        var filedata = {!! json_encode($filedata) !!};

        // Función para realizar la filtración
        function filtrarTabla() {
            var valorBuscado = $('#search').val().toLowerCase();
            var filas = $('#project tbody tr');

            filas.each(function () {
                var fila = $(this);
                var textoFila = fila.text().toLowerCase();

                if (textoFila.includes(valorBuscado)) {
                    fila.show();
                } else {
                    fila.hide();
                }
            });
        }

        // Llamar a la función de filtrado cuando se cambie el valor del campo de búsqueda
        $('#search').on('input', function () {
            filtrarTabla();
        });

        // Inicialmente, mostrar todos los registros
        filtrarTabla();
    </script>
    

@endsection