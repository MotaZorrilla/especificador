@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Crear Proyectos | Administradores ',
    ])
    <div class="container-fluid py-4">
        <div class="card border shadow">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="container py-5 col-6">
                    @if ($user->profile_count > 0)
                        <div class="alert alert-info text-white">
                            Tienes {{ $user->profile_count }} perfiles disponibles para tus proyectos.
                        </div>
                        <!-- Aquí puedes mostrar información adicional sobre los perfiles -->
                    @else
                        <div class="alert alert-warning text-white">
                            No tienes perfiles disponibles. Debes agregar nuevos Perfiles para tus proyectos.
                        </div>
                    @endif

                    <form id="projectForm" action="{{ route('projectAdmin.store') }}" method="post">
                        @csrf
                        @if (Session::has('message'))
                            <p>{{ Session::get('message') }}</p>
                        @endif

                        <div>
                            <h3>Crear un Nuevo Proyecto</h3>
                        </div>

                        {{-- nombre del proyecto --}}
                        <div class="form-group">
                            <label class="form-control-label" for="project">Nombre del Proyecto:</label>
                            <input class="form-control" type="text" id="project" name="project"
                                placeholder="Escribe el nombre de tu Proyecto" required>
                        </div>

                        {{-- descripcion del Proyecto --}}
                        <div class="form-group">
                            <label class="form-control-label" for="description">Descripción del Proyecto:</label>
                            <textarea class="form-control" type="text" id="description" name="description" rows="10" style="height: 100px;"
                                placeholder="Escribe la descripción de tu Proyecto"></textarea>
                        </div>

                        <button  type="submit" id="btnGuardar" class="btn btn-info justify-content-center"
                            style="display: none;">
                            Guardar
                        </button>

                    </form>

                    {{-- botones --}}
                    <div class="d-flex mt-3">
                        <div>
                            <button id="buttonsProject1" type="button" class="btn bg-gradient-success m-1"
                                style="width: 170px;" data-bs-toggle="modal" data-bs-target="#modalAddProject">
                                Crear Proyecto
                            </button>
                        </div>
                        <div>
                            <form action="{{ route('projectAdmin.index') }}" method="get">
                                <button id="buttonsProject2" type="submit" class="btn bg-gradient-danger m-1"
                                    style="width: 170px;">
                                    Volver, Sin Guardar
                                </button>
                            </form>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalAddProject" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-gradient-success ">
                                        <h1 class="modal-title fs-5 text-white">
                                            Su Proyecto Será Creado</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>¡El Nombre de su Proyecto <br>
                                            No se podrá modificar una vez guardado! <br>
                                            {{ $user->username }} <br>
                                            ¿Deseas Crear el Nuevo Proyecto?</p>
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn btn-info" style="display: none;"
                                            data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#projectForm"
                                            onclick="event.preventDefault(); document.getElementById('projectForm').submit();">
                                            No, Solo Guardar
                                        </button> --}}
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                            data-bs-toggle="modal"
                                            onclick="document.getElementById('btnGuardar').style.display = 'block';
                                            document.getElementById('buttonsProject1').style.display = 'none';
                                            document.getElementById('buttonsProject2').style.display = 'none';">
                                            Si, Crear Proyecto
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            Cancelar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/../assets/js/create.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descripcion'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
