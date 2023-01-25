@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <!-- Data Tables Files 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/>-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
    <style>
        .paginate_button {
            color: var(--link-color);
            background-color: transparent;
            border-color: blue;
            margin-left: 10px;
            line-height: 1.5;
            border-radius: 0.25rem;
        }       
    </style>
   
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Proyectos'])
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
                                    </tr>
                                </thead>
                                <!--<tbody-->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
    <!-- DataTable js -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.boot"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/resp"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
            $('#project').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    
                    zeroRecords:  "Nada Encontrado - Intente otra Busqueda",
                    info:         "Mostrando la Página _PAGE_ de _PAGES_",
                    infoEmpty:    "Nada Encontrado",
                    infoFiltered: ", Registros de Pinturas en la Base de Datos: _MAX_ ",
                    search:       "Buscar:",
                    paginate: {
                                    next: ' Siguiente   ',
                                    previous: 'Anterior '
                    },
                    
                    lengthMenu:   "Mostrar _MENU_ Registros por Página",
                    
                    decimal: ",",
                    thousands: "."
                },

                //scrollY: '200px',

                ajax: '{{ route('project.show') }}',
                columns: [
                            {data: 'id'},
                            {data: 'nombre'},
                            {data: 'perfil'},
                            {data: 'masividad'},
                            {data: 'resistencia'},
                            {data: 'updated_at',
                            "render": function ( data, type, row, meta ) {
                                var date = new Date(data);
                                return moment(date).fromNow();
                                }
                            }
                        ],                        
            });
    </script>
@endsection