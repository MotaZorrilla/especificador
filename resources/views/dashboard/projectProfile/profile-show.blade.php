@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos | Perfiles | Mostrar'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <h3>Perfil: "{{ $profile->nombre }}"</h3>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
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
                        <div class="container py-5 col-5">
                            <form action="{{ route('projectProfile.update', $profile) }}" method="post">
                                @csrf
                                @method('put')
                                @if (Session::has('message'))
                                    <p>{{ Session::get('messsage') }}</p>
                                @endif
                                <div class="form-group">
                                    <label class="form-control-label" for=>Descripción:</label>
                                    <p>{{ $profile->descripcion }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Tipo Perfil:</label>
                                    <p>{{ $profile->perfil }} {{ $profile->forma ? "con $profile->forma" : '' }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Masividad:</label>
                                    <p>{{ number_format($profile->masividad, 0) }} m<sup>-1</sup></p>
                                </div>
                                <div class="form-group">
                                    <label for="mass" class="form-control-label">Resistencia al Fuego:</label>
                                    <p>{{ number_format($profile->resistencia, 0) }} minutos</p>
                                </div>
                                <div>
                                    @if ($results->count())
                                        <table class="table align-items-center mb-4 table-striped" cellpadding="10">
                                            <thead>
                                                <tr>
                                                    <th>Pintura</th>
                                                    <th>Modelo</th>
                                                    <th>Certificado</th>
                                                    <th>Numero</th>
                                                    <th>Espesor mínimo<br> recomendado</th>
                                                    <th>Incluir</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($results as $result)
                                                    <tr>
                                                        <td class="text-center">{{ $result->pintura }}</td>
                                                        <td class="text-center">{{ $result->modelo }}</td>
                                                        <td class="text-center">{{ $result->certificado }}</td>
                                                        <td class="text-center">{{ $result->numero }}</td>
                                                        <td class="text-center">{{ $result->minimo }}</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" name="selectedPaints[]" value="{{ $result->id }}" {{ $result->incluir ? 'checked' : '' }}>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            
                                        </table>
                                    @else
                                        <div class="alert alert-warning text-white mx-3">
                                            No hay pinturas que cumplan con lo especificado.
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="mb-4">
                                        <label class="form-control-label" for="observaciones">Observaciones:</label>
                                        <textarea rows="8" class="form-control" id="observaciones"
                                            name="observaciones"
                                            @if (empty($profile->observaciones)) placeholder="Escribe las observaciones de tu Proyecto"></textarea>
                                            @else
                                            >{{ $profile->observaciones }} @endif
                                            </textarea>
                                            </div>
                                            <div class="d-flex ">
                                                <div>
                                                    <button type="submit" class="btn bg-gradient-info m-1">Actualizar</button>
                                                </div>
                                                <div class="d-flex ">
                                                    <form action="{{ route('projectProfile.edit', $profile) }}" method="get" >
                                                        <button type="submit" class="btn bg-gradient-success m-1">Editar</button>
                                                    </form>
                                                    <form action="{{ route('projectAdmin.destroy', $profile) }}" method="post" >
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn bg-gradient-danger m-1">Eliminar</button>
                                                    </form>
                                                    <form action="{{ route('projectAdmin.index') }}" method="get" >
                                                        <button type="submit" class="btn bg-gradient-success m-1">Volver</button>
                                                    </form>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@section('js')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>

    {{-- <script>
        ClassicEditor
            .create(document.querySelector('#descripcion'))
            .then(editor => {
                // Activa el modo de solo lectura
                editor.enableReadOnlyMode( 'feature-id' );
            })
            .catch(error => {
                console.error(error);
            });
    </script> --}}
                                                                {{-- <script>
        ClassicEditor
            .create(document.querySelector('#observaciones'))
            .catch(error => {
                console.error(error);
            });
    </script> --}}
@endsection
