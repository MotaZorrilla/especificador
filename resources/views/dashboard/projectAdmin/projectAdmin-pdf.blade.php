<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Especificador de Pintura Intumescente</title>
    <link rel="stylesheet" href=".\assets\css\pdf.css">
</head>

<body>
    <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
    <header class="header">
        <div class="logo-info">
            <img src=".\assets\img\logoEntumescenteB.png" alt="Logo">
        </div>
        <div class="project-info">
            <p>Proyecto de Pintura Intumescente</p>
            <p>{{ ucfirst($project['project']->project) ?? 'N/A' }}</p>
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
                        <td>{{ $project['user']->firstname ?? 'Firstname' }} {{ $project['user']->lastname ?? 'Lastname' }}</td>
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
            <p>{{ ucfirst($project['project']->project) ?? 'N/A' }}</p>
            <h3>Descripción:</h3>
            <p>{{ ucfirst($project['project']->description) }}</p>
            <h3>Observaciones: </h3>
            <p>{{ ucfirst($project['project']->observations) ?? 'N/A' }}</p>

            @foreach ($profiles as $profile)
                <div class="profiles">
                    <h3>Nombre del Perfil: </h3>
                    <p> {{ ucfirst($profile->nombre) ?? 'N/A' }}</p>
                    <h3>Tipo de Perfil: </h3>
                    <p> {{ $profile->perfil ?? 'N/A' }} </p>
                    <h3>Resistencia al fuego: </h3>
                    <p> {{ number_format($profile->resistencia, 0) ?? 'N/A' }} min</p>
                    <h3>Masividad: </h3>
                    <p>{{ number_format($profile->masividad, 0) ?? 'N/A' }} m<sup>-1</sup></p>

                    <br />
                    <h3>Medidas</h3>
                    @foreach (['altura', 'base1', 'base2', 'espesor1', 'espesor2', 'espesort', 'radio', 'plieque', 'diametro'] as $property)
                        @if (isset($profile->$property))
                            <p>{{ ucfirst($property) }}: {{ $profile->$property }}</p>
                        @endif
                    @endforeach

                    @php
                        // Filtrar los resultados solo para el perfil actual que tiene 'incluir' establecido en verdadero
                        $filteredResults = $results->where('profile_id', $profile->id);
                    @endphp

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
                                @forelse ($filteredResults as $result)
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
                </div>
            @endforeach

            <br />
            <div class="important-notes">
                <h3><u>Notas Importantes:</u></h3>
                <br />
                <p>Se debe solicitar al proveedor de la pintura intumescente: </p>
                <ul>
                    <li>Certificado oficial de ensayo. </li>
                    <li>Certificación lote a lote. </li>
                    <li>Anticorrosivos compatibles. </li>
                    <li>Sellos de terminación compatibles. </li>
                    <li>Ficha técnica. </li>
                </ul>
                <p>Se debe tener en consideración que: </p>
                <ul>
                    <li>Las condiciones climáticas de temperatura y humedad relativa restringen la aplicación de
                        las
                        pinturas intumescentes.
                        consulte al proveedor. </li>
                    <li>Dependiendo del tipo de pintura intumescente escogido, varían los tiempos de secado
                        entre
                        capas
                        y fraguado final,
                        consulte al proveedor. </li>
                </ul>
                <p>Para validar la correcta aplicación y cumplimiento de la norma NCh3040.Of2007 se debe:
                </p>
                <ul>
                    <li>Solicitar inspección e informe de la correcta aplicación de la pintura intumescente a un
                        organismo acreditado por el INN en la NCh3040, no contar con la inspección y el informe
                        de
                        un
                        organismo acreditado, es un incumplimiento normativo, lo que puede generar problemas de
                        coberturas de seguros y responsabilidades legales.</li>
                    <li>El organismo debe:
                        <ul>
                            <li>Verificar que los espesores cumplan con los del proyecto</li>
                            <li>Medir espesores</li>
                            <li>Realizar pruebas de ácido y quema</li>
                            <li>Verificar la aplicación según la ficha y los requerimientos de la pintura</li>
                            <li>Verificar que se cumpla con el ensayo oficial</li>
                            <ul>
                                <li>Deben verificar las masividades y que los espesores están de acuerdo a la
                                    masividad
                                    y el factor requerido.</li>
                            </ul>
                        </ul>
                    </li>
                    <li>Los organismos acreditados los encuentra en la página del INN
                        <ul>
                            <li>https://acreditacion.innonline.cl/</li>
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
        </div>
    </main>

    <footer class="footer">
        <div class="footer">
            <div class="footer-item">
                <a href="https://www.pinturaintumescente.cl/" target="_blank">pinturaintumescente.cl</a>
            </div>
            <div class="footer-item">
                <img src=".\assets\img\LogoNeobranding.png" alt="Logo Neobranding">
            </div>
            <div class="footer-item">
                <p>&copy; {{ date('Y') }}</p>
            </div>
        </div>
    </footer>
</body>

</html>
