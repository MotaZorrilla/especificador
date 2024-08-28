<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Especificador de Pintura Intumescente</title>
    <link rel="stylesheet" href="./assets/css/pdf.css"> 
</head>

<body>
    <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
    <header class="header">
        <div class="logo-info">
            <img src="./assets/img/logoEntumescenteB.png" alt="Logo">
        </div>
        <div class="project-info">
            <p>Proyecto de Pintura Intumescente</p>
            <p>{{ ucfirst($project->project) ?? 'N/A' }}</p>
            <p>Fecha de emisión: {{ $date }}</p>
        </div>
    </header>
    <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
    <main>
        <h2><u>Proyecto de Pintura Intumescente</u></h2>
        <div class="user">
            <h3>Usuario</h3>
            <div class="columnas">
                <table>
                    <tr>
                        <td>Nombre:</td>
                        <td>{{ $project['user']->firstname ?? 'Firstname' }}
                            {{ $project['user']->lastname ?? 'Lastname' }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{ $project['user']->email ?? 'email' }}</td>
                    </tr>
                    <tr>
                        <td>Dirección:</td>
                        <td>{{ $project['user']->address ?? 'address' }} {{ $project['user']->city ?? 'city' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="project">
            <h3>Datos del proyecto: </h3>
            <p>{{ ucfirst($project->project) ?? 'N/A' }}</p>
            <h3>Descripción:</h3>
            <p>{{ ucfirst($project->description) }}</p>
            <h3>Observaciones: </h3>
            <p>{{ ucfirst($project->observations) ?? 'N/A' }}</p>
        </div>
        @foreach ($profiles as $profile)
            <div style="width: 480px;">
                <div class="profiles ">
                    <h3>Nombre del Perfil: </h3>
                    <p> {{ ucfirst($profile->nombre) ?? 'N/A' }}</p>
                    <h3>Descripción del Perfil: </h3>
                    <p> {{ ucfirst($profile->observaciones) ?? 'N/A' }}</p>
                    <h3>Exposición del Perfil: </h3>
                    <p> {{ ucfirst($profile->exposicion) ?? 'N/A' }}</p>
                    <h3>Tipo de Perfil: </h3>
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
                        $profileProperties = $properties->filter(function ($label, $property) use ($profile) {
                            return isset($profile->$property);
                        });
                        // Verificamos si debe mostrarse la coletilla de forma completa
                        $mostrarFormaCompleta = !(
                            $profile->perfil == 'Perfil Abierto' && $profileProperties->isEmpty()
                        );
                        $formaCompleta = $mostrarFormaCompleta ? $formasCompletas[$profile->forma] : '';
                    @endphp
                    <p>{{ $profile->perfil }} {{ $formaCompleta }}</p>
                    <h3>Resistencia al fuego: </h3>
                    <p> {{ number_format($profile->resistencia, 0) ?? 'N/A' }} minutos</p>
                    <h3>Medidas:</h3>
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
                    <h3>Masividad: </h3>
                    <p>{{ number_format($profile->masividad, 0) ?? 'N/A' }} m<sup>-1</sup></p>
                </div>
                {{-- imagen del perfil --}}
                <div class="profile-image">
                    @if (!($profile->perfil == 'Perfil Abierto' && $profileProperties->isEmpty()))
                        @if ($profile->exposicion == 'Viga 3 Caras')
                            <img id="imgPerfil" src="./assets/img/Cortes/3_caras/{{ $profile->forma }}.png"
                            style="max-width: 100%">
                        @else
                            <img id="imgPerfil" src="./assets/img/Cortes/4_caras/{{ $profile->forma }}.png"
                                style="max-width: 100%">
                        @endif
                    @endif
                </div>
            </div>

            <div class="paint-recommendation">
                <h3>Recomendación de pinturas</h3>

                <table class="table ">
                    <thead>
                        <tr class="cabeceraTabla">
                            <th>Pintura</th>
                            <th>Modelo</th>
                            <th>Certificado</th>
                            <th>Numero</th>
                            <th>Espesor mínimo<br> recomendado</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($profile->results->where('incluir', true) as $result)
                            <tr>
                                <td>{{ $result->pintura ?? 'N/A' }}</td>
                                <td>{{ $result->modelo ?? 'N/A' }}</td>
                                <td>{{ $result->certificado ?? 'N/A' }}</td>
                                <td>{{ $result->numero ?? 'N/A' }}</td>
                                <td>{{ $result->minimo ?? 'N/A' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay resultados disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endforeach

        <br />
        <div class="important-notes">
            <h3><u>Notas Importantes:</u></h3>
            <br />
            <p>Se debe solicitar al proveedor de la pintura intumescente: </p>
            <ul>
                <li>Certificado oficial de ensayo o asimilación con ensayo internacional. </li>
                <li>Certificación lote a lote. </li>
                <li>Anticorrosivos compatibles. </li>
                <li>Sellos de terminación compatibles. </li>
                <li>Ficha técnica. </li>
            </ul>
            <p>Se debe tener en consideración que: </p>
            <ul>
                <li>Las condiciones climáticas de temperatura y humedad relativa restringen la aplicación de
                    las pinturas intumescentes. Consulte al proveedor. </li>
                <li>Dependiendo del tipo de pintura intumescente escogida, varían los tiempos de secado
                    entre capas y fraguado final. Consulte al proveedor. </li>
            </ul>
            <p>Para validar la correcta aplicación y cumplimiento de la norma NCh3040.Of2007 se debe:
            </p>
            <ul>
                <li>Solicitar inspección e informe de la correcta aplicación de la pintura intumescente a un
                    organismo acreditado por el INN en la NCh3040, no contar con la inspección y el informe
                    de un organismo acreditado, es un incumplimiento normativo, lo que puede generar problemas de
                    coberturas de seguros y responsabilidades legales.</li>
                <li>El organismo debe:
                    <ul>
                        <li>que la pintura especificada sea valida, es decir, que cuente con ensayo oficial
                            vigente o con asimilación de ensayo internacional vigente.</li>
                        <li>Verificar que la especificación respete las masividades según definición de Nch935/1 y
                            respete la resistencia al fuego exigida por proyecto y que le corresponde por OGUC.</li>
                        <li>Verificar que la pintura esta bien aplicada en terreno realizando las pruebas y
                            mediciones correspondientes.</li>
                        <li>Verificar que los espesores cumplen con los espesores requeridos según la masividad
                            de cada perfil.</li>
                        <li>Concluir si los perfiles dan o no cumplimiento a la resistencia al fuego requerida por
                            proyecto y por OGUC, respetando la norma Nch935/1.</li>
                    </ul>
                </li>
                <li>Los organismos acreditados los encuentra en la página del INN
                    <ul>
                        <li><span style="color: blue;">https://acreditacion.innonline.cl/</span></li>
                        <ul>
                            <li>Tipo de Esquema de Acreditación: Organismo de inspección</li>
                            <li>Área: Protección contra incendios</li>
                            <ul>
                                <li>Buscar</li>
                                <ul>
                                    <li>Entregará una lista con los acreditados</li>
                                </ul>
                            </ul>
                        </ul>
                    </ul>
                </li>
            </ul>
        </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer">
            <div class="footer-item">
                <a href="https://www.pinturaintumescente.cl/" target="_blank">pinturaintumescente.cl</a>
            </div>
            <div class="footer-item">
                <img src="./assets/img/LogoNeobranding.png" alt="Logo Neobranding">
            </div>
            <div class="footer-item">
                <p>&copy; {{ date('Y') }}</p>
            </div>
        </div>
    </footer>
</body>

</html>