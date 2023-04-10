<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Especificador de Pintura Intumescente</title>  
    <style>
        /**Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado puede ser de altura y anchura completas.**/
        @page {
        margin: 0cm 0cm;
        }

        /** Defina ahora los márgenes reales de cada página en el PDF **/
        body {
        font-family: "sans-serif", Helvetica, Arial ;
        font-size: 10px;
        margin-top: 3cm;
        margin-left: 0.5cm;
        margin-right: 0.5cm;
        margin-bottom: 3cm;
        line-height: 10px;
        }

        /** Definir las reglas del encabezado **/
        header {
        position: fixed;
        top: 0cm;
        left: 0cm;
        right: 0cm;
        height: 3cm;
        }

        /** Definir las reglas del pie de página **/
        footer {
        position: fixed;
        top: 98%;
        left: 0cm;
        right: 0cm;
        height: 3cm;
        z-index: 1;
        }
    </style>
</head>
<body>
    <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
    <header>
        <div >
        {{-- style="border: 1px solid red; "> --}}
          <div style="vertical-align: top; text-align: left; max-width: 50vw; display: inline-block;"> 
            {{-- border: 1px solid green; --}}
            <p><img src="C:\xampp\htdocs\Especificador\public\assets\img\logoEntumescenteB.png" alt="Logo" style="max-height: 80px;"></p>
          </div> 
          <div style="vertical-align: top; text-align: right;  max-width: 50vw; display: inline-block;">
            {{-- border: 1px solid blue; --}}
            <p>Proyecto de Pintura Intumescente<br/>
            Fecha de emisión: {{ $fecha_emision = date('d-m-Y') }}</p>
          </div>
        </div>
    </header>
      
      
      

    <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
    <main >
        {{-- style="border: 1px solid red; "> --}}
        {{-- datos-usuario --}}
        <h3 
        {{-- style="border: 1px solid red; " --}}
        >Datos del usuario</h3>
            <div class="columnas">
                <p>Nombre completo:  {{ auth()->user()->firstname ?? 'Firstname' }} {{ auth()->user()->lastname ?? 'Lastname' }}</p>
                <p>RUT:</p>
                <p>Email: {{ auth()->user()->email ?? 'email' }}</p>
                <p>Región:</p>
                <p>Comuna:</p>
                <p>Sitio web:</p>
            </div>
        {{-- datos-proyecto --}}
        <div >
        {{-- style="border: 1px solid red; "> --}}
            <h3>Datos del proyecto: {{  $projectAdmin->nombre }}</h3>
            <p>Nombre perfil:</p>
            <h3>Descripción:</h3>
            <p>{{ $projectAdmin->descripcion }}</p>
            <p>Tipo perfil: {{ $projectAdmin->perfil }} </p>
            <p>Resistencia al fuego: {{  $projectAdmin->resistencia  }} min</p>
            <p>Masividad: {{ $projectAdmin->masividad }}</p>
            <br/>
            <h4>Medidas</h4>
            <ul>
                <li>Altura (H):{{ $projectAdmin->altura }}</li>
                <li>Base (B):{{ $projectAdmin->base1 }}</li>
                <li>Espesor (e):{{ $projectAdmin->espesor1 }}</li>
            </ul>
                            
        <div> 
            {{-- style="border: 1px solid red; "> --}}
            <h3>Recomendación de pinturas</h3>
        </div>
        
        <table class="table align-items-center mb-0 table-striped" cellpadding="10"> {{-- style="border: 1px solid red; "> --}}
            <thead>
                <tr>
                    <th>Pintura</th>
                    <th>Modelo</th>
                    <th>Certificado</th>
                    <th>Numero</th>
                    <th>Espesor mínimo<br> recomendado</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <br/>
        <h3>Observaciones: </h3
        @if (!empty($projectAdmin->observaciones))
            <p>{{ $projectAdmin->observaciones }}</p>
        @endif

        <h3 style="border: 1px solid red; "><u>Notas importantes</u></h3>
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
                                   
    </main>
    
    <footer>
        <div >
        {{-- style="border: 1px solid red; text-align:center;"> --}}
          <div style="display:inline-block; vertical-align:center; border: 1px solid blue; max-width: 33%; margin: 0 auto;">
            <p><a href="https://www.pinturaintumescente.cl/">https://www.pinturaintumescente.cl/</a></p>
          </div>
          <div style="display:inline-block; vertical-align:center; border: 1px solid green; max-width: 33%; margin: 0 auto;">
            <img src="https://neobranding.cl/wp-content/uploads/2020/09/cropped-logo1_neo.png" style="max-width: 150px;"/>
          </div>
          <div style="display:inline-block; vertical-align:center; border: 1px solid blue; max-width: 33%; margin: 0 auto;">
            <p>© <?php echo date("Y");?></p>
          </div>
        </div>
    </footer>
      
    
      
        
</body>
</html>