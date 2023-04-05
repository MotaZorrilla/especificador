<!DOCTYPE html>
<html lang="e">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Especificador de Pintura Intumescente</title>
    <!-- Nucleo Icons -->
    <link href="/../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="/../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="/../assets/css/argon-dashboard.css" rel="stylesheet" />
    
</head>
<body>
    <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4 border border-primary">
        <div class="container-fluid">
            <div>
                <a class="navbar-brand ms-lg-0 ms-3" href="{{ route('home') }}">
                    <img src="C:\xampp\htdocs\Especificador\public\assets\img\logoEntumescenteB.png" alt="Logo" style="max-width: 250px;">
                </a>  
            </div>
            <div class="header d-flex flex-column align-items-end">
                <h3>Proyecto de Pintura Intumescente</h3>
                <p>Fecha de emisión: {{ $fecha_emision = date('d-m-Y') }}</p>
            </div>
        </div>
    </nav>
    
   
    
    
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">  
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container py-5 col-5">   
                            <div class="datos-usuario">
                                <h3>Datos del usuario</h3>
                                <p>Nombre completo:  {{ auth()->user()->firstname ?? 'Firstname' }} {{ auth()->user()->lastname ?? 'Lastname' }}</p>
                                <p>RUT:</p>
                                <p>Email: {{ auth()->user()->email ?? 'email' }}</p>
                                <p>Región:</p>
                                <p>Comuna:</p>
                                <p>Sitio web:</p>
                            </div>
                            <div class="datos-proyecto">
                                <h3>Datos del proyecto: {{  $projectAdmin->nombre }}</h3>
                                <p>Nombre perfil:</p>
                                <h6>Descripción:</h6>
                                <p>{{ $projectAdmin->descripcion }}</p>
                                <p>Tipo perfil: {{ $projectAdmin->perfil }} </p>
                                <p>Resistencia al fuego: {{  $projectAdmin->resistencia  }} min</p>
                                <p>Masividad: {{ $projectAdmin->masividad }}</p>
                                <p>Longitud:</p>
                                <h4>Medidas</h4>
                                <ul>
                                    <li>Altura (H):</li>
                                    <li>Base (B):</li>
                                    <li>Espesor (e):</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <div class="recomendacion-pinturas">
        <h3>Recomendación de pinturas</h3>
    </div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">  
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container py-5 col-5">   
                            <div>
                                <table class="table align-items-center mb-0 table-striped" cellpadding="10">
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
                                        @foreach($filedata as $filedatum)
                                            <tr>
                                                <td>{{ $filedatum->pintura }}</td> 
                                                <td>{{ $filedatum->modelo }}</td> 
                                                <td class="text-center">{{ $filedatum->certificado }}</td>
                                                <td class="text-center">{{ $filedatum->numero }}</td>
                                                @if ($projectAdmin->resistencia == 15)
                                                    <td class="text-center">{{ $filedatum->m15 }}</td>
                                                @elseif ($projectAdmin->resistencia == 30)
                                                    <td class="text-center">{{ $filedatum->m30 }}</td>
                                                @elseif ($projectAdmin->resistencia == 60)
                                                    <td class="text-center">{{ $filedatum->m60 }}</td>
                                                @elseif ($projectAdmin->resistencia == 90)
                                                    <td class="text-center">{{ $filedatum->m90 }}</td>
                                                @endif
                                                <td class="text-center"><input type="checkbox" name="seleccionados[]" value="{{ $filedatum->id }}" checked=""></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <br/>
                                <h3>Observaciones: </h3
                                @if (!empty($projectAdmin->observaciones))
                                    <p>{{ $projectAdmin->observaciones }}</p>
                                @endif
                            </div>
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
                            <div class="notas-importantes">
                                <h3><u>Notas importantes</u></h3>
                                <br style="page-break-after: always;" />
                                <p><u>Se debe solicitar al proveedor de la pintura intumescente:    </u></p>
                                <ul>
                                    <li>Certificado oficial de ensayo.      </li>
                                    <li>Certificación lote a lote.          </li>
                                    <li>Anticorrosivos compatibles.         </li>
                                    <li>Sellos de terminación compatibles. </li>
                                    <li>Ficha técnica.                      </li>
                                </ul>
                                <p><u>Se debe tener en consideración que:                           </u></p>
                                <ul>
                                    <li>Las condiciones climáticas de temperatura y humedad relativa restringen la aplicación de las pinturas intumescentes.
                                        consulte al proveedor.              </li>
                                    <li>Dependiendo del tipo de pintura intumescente escogido, varían los tiempos de secado entre capas y fraguado final,
                                        consulte al proveedor.              </li>
                                </ul>
                                <p><u>Para validar la correcta aplicación y cumplimiento de la norma NCh3040.Of2007 se debe:</u></p>
                                <ul>
                                    <li>Solicitar inspección e informe de la correcta aplicación de la pintura intumescente a un organismo acreditado por el INN en la NCh3040, no contar con la inspección y el informe de un organismo acreditado, es un incumplimiento normativo, lo que puede generar problemas de coberturas de seguros y responsabilidades legales.</li>
                                    <li>El organismo debe:
                                        <ul>
                                            <li>Verificar que los espesores cumplan con los del proyecto</li>
                                            <li>Medir espesores</li>
                                            <li>Realizar pruebas de ácido y quema</li>
                                            <li>Verificar la aplicación según la ficha y los requerimientos de la pintura</li>
                                            <li>Verificar que se cumpla con el ensayo oficial</li>
                                            <ul>
                                                <li>Deben verificar las masividades y que los espesores están de acuerdo a la masividad y el factor requerido.</li>
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
                                <p><a href="https://www.pinturaintumescente.cl/">https://www.pinturaintumescente.cl/</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="https://neobranding.cl/wp-content/uploads/2020/09/cropped-logo1_neo.png"/>
</body>
</html>