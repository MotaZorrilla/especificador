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
    @include('layouts.navbars.auth.topnav', ['title' => 'Crear'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="container">
                        <div class="card-header pb-0">
                            <h2>Proyectos</h2>
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
                        <div class="container py-5">   
                            <form action="#" method="post" >
                                @csrf
                                @if (Session::has('message'))
                                    <p>{{ Session::get('messsage')}}</p>
                                @endif
                                
                                <div>
                                    
                                </div>
                                <div>
                                    <h3>Crear un Nuevo Proyecto</h3>
                                </div>
                                <div class="form-group">
                                    <label for="project_data" class="form-control-label">Datos del proyecto:</label>
                                    <input class="form-control" type="text" id="project_data" name="project_data" value="Prueba 500">
                                </div>
                                <div class="form-group">
                                    <label for="profile_name" class="form-control-label">Nombre perfil:</label>
                                    <input class="form-control" type="text" id="profile_type" name="profile_type" value="Pilar 4 caras expuestas">
                                </div>
                                <div class="form-group">
                                    <label for="fire_resistance" class="form-control-label">Resistencia al fuego:</label>
                                    <input class="form-control" type="number" id="fire_resistance" name="fire_resistance" value="60">
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Masividad:</label>
                                    <input class="form-control" type="number" id="mass" name="mass" value="171">
                                </div>
                                <div>
                                    <button class="badge badge-sm bg-gradient-success px-3" type="submit">Crear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
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

                ajax: '{{ route('datatable') }}',
                columns: [
                            {data: 'id'},
                            /*{data: ''},
                            {data: 'modelo'},
                            {data: 'certificado'},
                            {data: 'numero'},
                            {data: 'masividad'},
                            {data: 'm15'},
                            {data: 'm30'},
                            {data: 'm60'},
                            {data: 'm90'},*/
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
