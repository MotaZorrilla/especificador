@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos | Perfiles | Mostrar'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="container-lg ">
                <div class="card mb-4">
                    <div class="card-header pb-4">
                        <h3>Proyecto: "{{ $profile['project']->project }}"</h3>
                        <p>"{{ $profile['project']->description }}"</p>
                        <h3>Perfil: "{{ $profile->nombre }}"</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container-md">
                <div class="card mb-4">
                    <div class="px-4 pt-4">
                        @if ($successMessage)
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <p class="text-white mb-0">{{ $successMessage }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container py-5 ">
                            <form action="{{ route('projectProfile.update', $profile) }}" method="post">
                                @csrf
                                @method('put')
                                @if (Session::has('message'))
                                    <p>{{ Session::get('messsage') }}</p>
                                @endif
                                <div class="row mb-5">
                                    <div class="container-lg ">
                                        <div class="form-group">
                                            <label class="form-control-label" for=>Descripción:</label>
                                            <p>{{ $profile->descripcion }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for=>Exposión:</label>
                                            <p>{{ $profile->exposicion }}</p>
                                        </div>
                                        <div class="form-group ">
                                            <label for="mass" class="form-control-label">Tipo Perfil:</label>
                                            @php
                                                $formasCompletas = [
                                                    'C' => 'con forma tipo "C"',
                                                    'CA' => 'con forma tipo "CA"',
                                                    'Circular' => '',
                                                    'HCR' => 'con forma tipo "H" con Radio',
                                                    'HSR' => 'con forma tipo "H" sin Radio',
                                                    'IC' => 'con forma tipo "IC"',
                                                    'ICA' => 'con forma tipo "ICA"',
                                                    'L' => 'con forma tipo "L" ó Ángulo',
                                                    'OCA' => 'Cerrada tipo "OCA"',
                                                    'R' => '',
                                                    'Z' => 'con forma tipo "Z"',
                                                ];
                                                $formaCompleta = $formasCompletas[$profile->forma];
                                                $properties = collect([
                                                    'altura' => 'Altura',
                                                    'base1' => 'Base 1',
                                                    'base2' => 'Base 2',
                                                    'espesor1' => 'Espesor 1',
                                                    'espesor2' => 'Espesor 2',
                                                    'espesort' => 'Espesor T',
                                                    'radio' => 'Radio',
                                                    'plieque' => 'Pliegue',
                                                    'diametro' => 'Diámetro',
                                                ]);
                                                $profileProperties = $properties->filter(function (
                                                    $label,
                                                    $property,
                                                ) use ($profile) {
                                                    return isset($profile->$property);
                                                });
                                                // Verificamos si debe mostrarse la coletilla de forma completa
                                                $mostrarFormaCompleta = !(
                                                    $profile->perfil == 'Perfil Abierto' &&
                                                    $profileProperties->isEmpty()
                                                );
                                                $formaCompleta = $mostrarFormaCompleta
                                                    ? $formasCompletas[$profile->forma]
                                                    : '';
                                            @endphp
                                            <p>{{ $profile->perfil }} {{ $formaCompleta }}</p>
                                            <div class="form-group ">
                                                <label for="mass" class="form-control-label">Medidas:</label>
                                                @if ($profileProperties->isEmpty())
                                                    <p>No se proporcionaron medidas.</p>
                                                @else
                                                    <table class="table medidas-table">
                                                        <tbody>
                                                            @foreach ($profileProperties as $property => $label)
                                                                <tr>
                                                                    <td><strong>{{ $label }}:</strong></td>
                                                                    <td>{{ $profile->$property }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                                <div class="form-group">
                                                    <label for="mass" class="form-control-label">Masividad:</label>
                                                    <p>{{ number_format($profile->masividad, 0) }} m<sup>-1</sup></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mass" class="form-control-label">Resistencia al
                                                        Fuego:</label>
                                                    <p>{{ number_format($profile->resistencia, 0) }} minutos</p>
                                                </div>
                                            </div>
                                            {{-- imagen del perfil --}}
                                            @if (!($profile->perfil == 'Perfil Abierto' && $profileProperties->isEmpty()))
                                                <div style="display: inline-block; vertical-align: top; " class="col-6">
                                                    <label class="form-control-label">Visualización del Perfil:</label>
                                                    <div>
                                                        @if ($profile->exposicion == 'Viga 3 Caras')
                                                            <img id="imgPerfil"
                                                                src="../assets/img/Cortes/3_caras/{{ $profile->forma }}.png"
                                                                style="max-width: 100%">
                                                        @else
                                                            <img id="imgPerfil"
                                                                src="../assets/img/Cortes/4_caras/{{ $profile->forma }}.png"
                                                                style="max-width: 100%">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <table class="table align-items-center mb-4 table-striped" cellpadding="10"> 
                                                <thead id="cabecera_pitura">
                                                    <tr>
                                                        <th>Pintura</th>
                                                        <th>Modelo</th>
                                                        <th>Certificado</th>
                                                        <th>Número de Certificado</th>
                                                        <th>Espesor mínimo recomendado</th>
                                                        <th>Incluir</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($profile->results as $resultado)
                                                        @if(is_null($resultado->minimo))
                                                            <!-- Pintura sin masividad asociada -->
                                                            <tr>
                                                                <td>{{ $resultado->pintura }}</td>
                                                                <td>{{ $resultado->modelo }}</td>
                                                                <td>{{ $resultado->certificado }}</td>
                                                                <td>{{ $resultado->numero }}</td>
                                                                <td><strong>Masividad <em>"NO"</em> Asociada</strong>  </td>
                                                                <td>
                                                                    <input type="checkbox" 
                                                                           name="selectedPaints[]" 
                                                                           value="{{ $resultado->id }}" 
                                                                           {{ $resultado->incluir ? 'checked' : '' }}>
                                                                </td>
                                                            </tr>
                                                        @else
                                                            <!-- Pintura con masividad asociada -->
                                                            <tr>
                                                                <td>{{ $resultado->pintura }}</td>
                                                                <td>{{ $resultado->modelo }}</td>
                                                                <td>{{ $resultado->certificado }}</td>
                                                                <td>{{ $resultado->numero }}</td>
                                                                <td>{{ $resultado->minimo }}</td>
                                                                <td>
                                                                    <input type="checkbox" 
                                                                           name="selectedPaints[]" 
                                                                           value="{{ $resultado->id }}" 
                                                                           {{ $resultado->incluir ? 'checked' : '' }}>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>                                        
                                        <div class="form-group">
                                            <div class="mb-4">
                                                <label class="form-control-label" for="observaciones">Observaciones:</label>
                                                <textarea rows="8" class="form-control" id="observaciones"
                                                    name="observaciones"
                                                    @if (empty($profile->observaciones)) placeholder="Escribe las observaciones de tu Proyecto">
                                                    @else
                                                        >{{ $profile->observaciones }}> @endif
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
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
