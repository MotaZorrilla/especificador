@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Crear Perfil | Administradores ',
    ])
    <div class="container-fluid py-4">
        <div class="card border shadow">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="container py-5 col-6">
                    @if ($user->profile_count > 0)
                        <div class="alert alert-info text-white f-bold">
                            Tienes {{ $user->profile_count }} Perfiles Disponibles.
                        </div>
                        <!-- Aquí puedes mostrar información adicional sobre los perfiles -->
                    @else
                        <div class="alert alert-warning text-white">
                            No tienes perfiles disponibles. Debes agregar nuevos antes de crear el proyecto.
                        </div>
                    @endif

                    <form id="profileForm" action="{{ route('projectProfile.store') }}" method="post">
                        @csrf
                        @if (Session::has('message'))
                            <p>{{ Session::get('message') }}</p>
                        @endif

                        <div>
                            <h3>Crear un Nuevo Perfil</h3>
                        </div>

                        {{-- Asosiar a Un proyecto --}}
                        <div class="mt-3">
                            <label class="form-control-label" for="project">Proyecto al que Pertenece el Perfil:</label>
                            <select class="form-select mb-3" id="project" name="project" required>
                                <option value="">Proyectos del Usuario</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->project }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- nombre del perfil --}}
                        <div class="form-group">
                            <label class="form-control-label" for="nombre">Nombre del Perfil:</label>
                            <input class="form-control" type="text" id="nombre" name="nombre"
                                placeholder="Escribe el nombre de tu Perfil" required>
                        </div>

                        {{-- descripcion del perfil --}}
                        <div class="form-group">
                            <label class="form-control-label" for="descripcion">Descripción del Perfil:</label>
                            <textarea class="form-control" type="text" id="descripcion" name="descripcion" rows="5"
                                placeholder="Escribe la descripción de tu Perfil"></textarea>
                        </div>

                        {{-- conozco masividad --}}
                        <div class="form-group">
                            <label class="form-control-label">¿Conozco la Masividad?:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="conozco_masividad"
                                    name="conozco_masividad" checked="">
                                <label class="form-check-label" for="conozco_masividad">Si, Conozco la
                                    Masividad</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="conozco_masividad_no"
                                    name="conozco_masividad">
                                <label class="form-check-label" for="conozco_masividad">No, no Conozco la
                                    Masividad</label>
                            </div>
                        </div>

                        {{-- Formulario si conozco la masividad --}}
                        <div id="form_masividad" name="form_masividad">

                            <div class="form-group">
                                <label for="masividad" class="form-control-label">Masividad:</label>
                                <input class="form-control" type="number" id="masividad" name="masividad"
                                    placeholder="Escribe la masividad de tu Perfil ">
                            </div>

                        </div>

                        {{-- Formulario tipo de perfil --}}
                        <div>
                            <div class="form-group">
                                <div class="row">

                                    {{-- exposición Columna o Viga --}}
                                    <div style="display: inline-block; vertical-align: top;" class="col-4">

                                        <label class="form-control-label">Exposición de Perfil:</label>
                                        <br />
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="Pilar 4 Caras"
                                                id="exposicion_p4c" name="exposicion" checked="">
                                            <label class="form-check-label" for="exposicion_p4c">Pilar 4
                                                Caras</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="Viga 4 Caras"
                                                id="exposicion_v4c" name="exposicion">
                                            <label class="form-check-label" for="exposicion_v4c">Viga 4
                                                Caras</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="Viga 3 Caras"
                                                id="exposicion_v3c" name="exposicion">
                                            <label class="form-check-label" for="exposicion_v3c">Viga 3
                                                Caras</label>
                                        </div>

                                    </div>

                                    {{-- tipo de abierto o cerrado --}}
                                    <div id="tipo_perfil" style="display: inline-block; vertical-align: top;"
                                        class="col-4">
                                        <label class="form-control-label">Tipo Perfil:</label>
                                        <br />
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="Perfil Abierto"
                                                id="perfil_A" name="perfil" checked="">
                                            <label class="form-check-label" for="perfil_A">Abierto</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                value="Perfil Cerrado Rectangular" id="perfil_cr" name="perfil">
                                            <label class="form-check-label" for="perfil_cr">Cerrado
                                                Rectangular</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio"
                                                value="Perfil Cerrado Circular" id="perfil_cc" name="perfil">
                                            <label class="form-check-label" for="perfil_cc">Cerrado
                                                Circular</label>
                                        </div>
                                    </div>

                                    {{-- resistencia   --}}
                                    <div style="display: inline-block; vertical-align: top;" class="col-4">
                                        <div class="form-group">
                                            <label for="resistencia" class="form-control-label">Resistencia al
                                                Fuego:</label>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="resistencia_15"
                                                    name="resistencia" value="15" checked="">
                                                <label class="form-check-label" for="resistencia_15">15
                                                    minutos</label>
                                            </div>
                                            <div class="form-check" style="display: inline-block;">
                                                <input class="form-check-input" type="radio" id="resistencia_30"
                                                    name="resistencia" value="30">
                                                <label class="form-check-label" for="resistencia_30">30
                                                    minutos</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="resistencia_60"
                                                    name="resistencia" value="60">
                                                <label class="form-check-label" for="resistencia_60">60
                                                    minutos</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="resistencia_90"
                                                    name="resistencia" value="90">
                                                <label class="form-check-label" for="resistencia_90">90
                                                    minutos</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="resistencia_120"
                                                    name="resistencia" value="120">
                                                <label class="form-check-label" for="resistencia_120">120
                                                    minutos</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Formulario forma del perfil --}}
                        <div id="forma_perfil" name="forma_perfil" style="display: none ">
                            <div class="form-group">
                                <div class="row">
                                    {{-- forma del perfil --}}
                                    <div style="display: inline-block; vertical-align: top; " class="col-3">
                                        <label class="form-control-label">Forma del Perfil:</label>
                                        <div id="forma_HSR" class="form-check">
                                            <input class="form-check-input" type="radio" value="HSR"
                                                id="r_forma_HSR" name="forma" checked="">
                                            <label class="form-check-label" id="l_forma_HSR" for="forma_HSR">H
                                                Sin Radio</label>
                                        </div>
                                        <div id="forma_HCR" class="form-check">
                                            <input class="form-check-input" type="radio" value="HCR"
                                                id="r_forma_HCR" name="forma">
                                            <label class="form-check-label" id="l_forma_HCR" for="forma_HCR">H
                                                Con Radio</label>
                                        </div>
                                        <div id="forma_R" class="form-check">
                                            <input class="form-check-input" type="radio" value="R" id="r_forma_R"
                                                name="forma">
                                            <label class="form-check-label" id="l_forma_R"
                                                for="forma_R">Rectangular</label>
                                        </div>
                                        <div id="forma_Circular" class="form-check">
                                            <input class="form-check-input" type="radio" value="Circular"
                                                id="r_forma_Circular" name="forma">
                                            <label class="form-check-label" id="l_forma_Circular"
                                                for="forma_Circular">Circular</label>
                                        </div>
                                        <div id="forma_C" class="form-check">
                                            <input class="form-check-input" type="radio" value="C" id="r_forma_C"
                                                name="forma">
                                            <label class="form-check-label" id="l_forma_C" for="forma_C">C</label>
                                        </div>
                                        <div id="forma_IC" class="form-check">
                                            <input class="form-check-input" type="radio" value="IC"
                                                id="r_forma_IC" name="forma">
                                            <label class="form-check-label" id="l_forma_IC" for="forma_IC">IC</label>
                                        </div>
                                        <div id="forma_CA" class="form-check">
                                            <input class="form-check-input" type="radio" value="CA"
                                                id="r_forma_CA" name="forma">
                                            <label class="form-check-label" id="l_forma_CA" for="forma_CA">CA</label>
                                        </div>
                                        <div id="forma_ICA" class="form-check">
                                            <input class="form-check-input" type="radio" value="ICA"
                                                id="r_forma_ICA" name="forma">
                                            <label class="form-check-label" id="l_forma_ICA" for="forma_ICA">ICA</label>
                                        </div>
                                        <div id="forma_OCA" class="form-check">
                                            <input class="form-check-input" type="radio" value="OCA"
                                                id="r_forma_OCA" name="forma">
                                            <label class="form-check-label" id="l_forma_OCA" for="forma_OCA">OCA</label>
                                        </div>
                                        <div id="forma_L" class="form-check">
                                            <input class="form-check-input" type="radio" value="L" id="r_forma_L"
                                                name="forma">
                                            <label class="form-check-label" id="l_forma_L" for="forma_L">L ó
                                                Ángulo</label>
                                        </div>
                                        <div id="forma_Z" class="form-check">
                                            <input class="form-check-input" type="radio" value="Z" id="r_forma_Z"
                                                name="forma">
                                            <label class="form-check-label" id="l_forma_Z" for="forma_Z">Z</label>
                                        </div>
                                    </div>

                                    {{-- imagen del perfil --}}
                                    <div style="display: inline-block; vertical-align: top; " class="col-5">
                                        <label class="form-control-label">Visualización del Perfil:</label>
                                        <div>
                                            <img id="imgPerfil" src="" style="max-width: 100% ">
                                        </div>
                                    </div>

                                    {{-- datos --}}
                                    <div id="form_datos" name="form_datos"
                                        style="display: inline-block; vertical-align: top; " class="col-4">
                                        <label class="form-control-label">Datos del Perfil:</label>
                                        <div class="form-group" id="d_H">
                                            <label class="form-control-label" for="dato_H">Altura:</label>
                                            <input class="form-control" type="number" step="0.01" id="dato_H"
                                                name="dato_H" placeholder="H (mm)">
                                        </div>
                                        <div class="form-group" id="d_B1">
                                            <label class="form-control-label" for="dato_B1">Base:</label>
                                            <input class="form-control" type="number" step="0.01" id="dato_B1"
                                                name="dato_B1" placeholder="B1 (mm)">
                                        </div>
                                        <div class="form-group" id="d_B2">
                                            <label class="form-control-label" for="dato_b2">Base 2:</label>
                                            <input class="form-control" type="number" step="0.01" id="dato_B2"
                                                name="dato_B2" placeholder="B2 (mm)">
                                        </div>
                                        <div class="form-group" id="d_C">
                                            <label class="form-control-label" for="dato_C">Pieque:</label>
                                            <input class="form-control" type="number" step="0.01" id="dato_C"
                                                name="dato_C" placeholder="C (mm)">
                                        </div>
                                        <div class="form-group" id="d_e1">
                                            <label class="form-control-label" for="dato_e1">Espesor:</label>
                                            <input class="form-control" type="number" step="0.01" id="dato_e1"
                                                name="dato_e1" placeholder="e (mm)">
                                        </div>
                                        <div class="form-group" id="d_e2">
                                            <label class="form-control-label" for="dato_e2">Espesor e2:</label>
                                            <input class="form-control" type="number" step="0.01" id="dato_e2"
                                                name="dato_e2" placeholder="e2 (mm)">
                                        </div>
                                        <div class="form-group" id="d_t">
                                            <label class="form-control-label" for="dato_t">Espesor t:</label>
                                            <input class="form-control" type="number" step="0.01" id="dato_t"
                                                name="dato_t" placeholder="t (mm)">
                                        </div>
                                        <div class="form-group" id="d_r">
                                            <label class="form-control-label" for=dato_r>Radio:</label>
                                            <input class="form-control" type="number" step="0.01" id="dato_r"
                                                name="dato_r" placeholder="r (mm)">
                                        </div>
                                        <div class="form-group" id="d_D">
                                            <label class="form-control-label" for="dato_D">Dimetro
                                                Exterior:</label>
                                            <input class="form-control" type="number" step="0.01" id="dato_D"
                                                name="dato_D" placeholder="D (mm)">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <button  type="submit" id="btnGuardarProfile" class="btn btn-info justify-content-center"
                            style="display: none;">
                            Guardar Perfil
                        </button>

                    </form>

                    {{-- botones --}}
                    <div class="d-flex mt-3">
                        <div>
                            <button id="buttonsProfile1" type="button" class="btn bg-gradient-success m-1" style="width: 200px;"
                                data-bs-toggle="modal" data-bs-target="#modalAddProfile">
                                Crear Perfil
                            </button>
                        </div>
                        <div>
                            <form action="{{ route('projectAdmin.index') }}" method="get">
                                <button id="buttonsProfile2" type="submit" class="btn bg-gradient-danger m-1" style="width: 200px;">
                                    Volver, Sin Guardar
                                </button>
                            </form>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalAddProfile" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-gradient-success ">
                                        <h1 class="modal-title fs-5 text-white">
                                            Su Perfil Será Creado</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>¡Los datos de su perfil <br>
                                            No se podrán modificar una vez guardados! <br>
                                            {{ $user->username }} <br>
                                            ¿Deseas Crear el Nuevo Perfil?</p>
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="btn bg-gradient-success" data-bs-dismiss="modal"
                                            data-bs-toggle="modal" data-bs-target="#profileForm"
                                            onclick="event.preventDefault(); document.getElementById('profileForm').submit();">
                                            Guardar
                                        </button> --}}
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                            data-bs-toggle="modal"
                                            onclick="document.getElementById('btnGuardarProfile').style.display = 'block';
                                            document.getElementById('buttonsProfile1').style.display = 'none';
                                            document.getElementById('buttonsProfile2').style.display = 'none';">
                                            Si, Crear Perfil
                                        </button>
                                        <button type="button" class="btn bg-gradient-danger" data-bs-dismiss="modal">
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
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#descripcion'))
            .catch(error => {
                console.error(error);
            });
    </script> --}}
@endsection
