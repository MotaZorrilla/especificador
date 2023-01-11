@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('css')
    <!-- Data Tables Files 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"/>-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.bootstrap5.min.css">
   
@endsection

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Importar y Exportar Tablas</h6>
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
                                            <form action="{{ route('import')}}" method="post" enctype="multipart/form-data">
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
                                                    <img src="/img/icons/export.png" class="avatar avatar-sm me-3">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Exportar Tablas</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-right text-sm">
                                            <a class="badge badge bg-gradient-secondary" href="{{route('export')}}">Exportar</a>
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
                        <h6>Datos de Pinturas</h6>
                    </div>
                    <div class="card-body px-3 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0" id="files">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            id</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Pintura
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Modelo
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Certificado
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Numero
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Masividad
                                        </th>   
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            15m
                                        </th> 
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            30m
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            60m
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            90m
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Actualizado
                                        </th>
                                    </tr>
                                </thead>
                                <!--<tbody>
                                    foreach ($files as $file)
                                    <tr>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->id }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->pintura }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->modelo }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->certificado }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->numero }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->masividad }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->m15 }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->m30 }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->m60 }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->m90 }}
                                        </td>
                                        <td class="text-xs text-center font-weight-bold ps-2">{ $file->updated_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                    endforeach                                   
                                </tbody>-->
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
            $('#files').DataTable({
                responsive: true,
                autoWidth: false,
                language: {
                    
                    zeroRecords:  "Nada Encontrado - Intente otra Busqueda",
                    info:         "Mostrando la Página _PAGE_ de _PAGES_",
                    infoEmpty:    "Nada Encontrado",
                    infoFiltered: ", Registros de Pinturas en la Base de Datos: _MAX_ ",
                    search:       "Buscar:",
                    paginate: {
                                    next: ' Siguiente',
                                    previous: 'Anterior '
                    },
                    
                    lengthMenu:   "Mostrar _MENU_ Registros por Página",
                    
                    decimal: ",",
                    thousands: "."
                },

                ajax: '{{ route('datatable') }}',
                columns: [
                            {data: 'id'},
                            {data: 'pintura'},
                            {data: 'modelo'},
                            {data: 'certificado'},
                            {data: 'numero'},
                            {data: 'masividad'},
                            {data: 'm15'},
                            {data: 'm30'},
                            {data: 'm60'},
                            {data: 'm90'},
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