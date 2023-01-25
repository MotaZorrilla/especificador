@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])


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
                        <div class="container py-5 col-5">   
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
                                    <label for="project_data" class="form-control-label">Nombre del Proyecto:</label>
                                    <input class="form-control" type="text" id="project_data" name="project_data" value="Prueba 500">
                                </div>
                                <div class="form-group">
                                    <label for="project_data" class="form-control-label">Descripción:</label>
                                    <textarea class="form-control" type="text" id="project_data" name="project_data" >
                                        Escribe la descripción de tu Proyecto
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">¿Conozco la Masividad?:</label>
                                    <br>
                                    <label>
                                    <input type="checkbox" id="cbox1" value="first_checkbox"> Si</label>
                                    <br>
                                    <input type="checkbox" id="cbox2" value="second_checkbox"> No</label>
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Tipo Perfil:</label>
                                    <input class="form-control" type="number" id="mass" name="mass" value="171">
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Masividad:</label>
                                    <input class="form-control" type="number" id="mass" name="mass" value="171">
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Resistencia al Fuego:</label>
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

