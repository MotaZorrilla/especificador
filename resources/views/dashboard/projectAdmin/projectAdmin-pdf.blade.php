<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report USUARIOS</title>
    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        table{
            font-size: x-small;
        }
        tfoot tr td{
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>
</head>
<body>
    
        <p>Estas son las pinturas que puedes usar</p>
    
    
    <table>
        <thead>
            <tr>
                <th>Pintura</th>
                <th>Modelo</th>
                <th>Certificado</th>
                <th>Numero</th>
                <th>Masividad</th>
                <th>15 m</th>
                <th>30 m</th>
                <th>60 m</th>
                <th>90 m</th>
        </thead>
        <tbody>
            @foreach($filedata as $filedatum)
                <tr>
                    <td>{{ $filedatum->pintura }}</td> 
                    <td>{{ $filedatum->modelo }}</td> 
                    <td>{{ $filedatum->certificado }}</td>
                    <td>{{ $filedatum->numero }}</td>
                    <td>{{ $filedatum->masividad }}</td>
                    <td>{{ $filedatum->m15 }}</td>
                    <td>{{ $filedatum->m30 }}</td>
                    <td>{{ $filedatum->m60 }}</td>
                    <td>{{ $filedatum->m90 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="header">
        <h1>Proyecto de Pintura Intumescente</h1>
        <h2>Fecha de emisión: {{ $fecha_emision = date('d-m-Y'); }}</h2>
    </div>
    <div class="datos-usuario">
        <h3>Datos del usuario</h3>
        <p><strong>Nombre completo:</strong> {{ auth()->user()->firstname ?? 'Firstname' }} {{ auth()->user()->lastname ?? 'Lastname' }}</p>
        <p><strong>RUT:</strong> { $rut }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email ?? 'email' }}</p>
        <p><strong>Región:</strong> { $region }}</p>
        <p><strong>Comuna:</strong> { $comuna }}</p>
        <p><strong>Sitio web:</strong> { $sitio_web }}</p>
    </div>
    <div class="datos-proyecto">
        <h3>Datos del proyecto: {{  $project->nombre }}</h3>
        <p><strong>Nombre perfil:</strong> { $nombre_perfil }}</p>
        <p><strong>Tipo perfil:</strong> { $tipo_perfil }}</p>
        <p><strong>Resistencia al fuego:</strong> {{  $project->resistencia  }} min</p>
        <p><strong>Masividad:</strong> {{  $project->masividad  }}</p>
        <p><strong>Longitud:</strong> { $longitud }} m</p>
        <h4>Medidas</h4>
        <ul>
            <li><strong>Altura (H):</strong> { $altura }}</li>
            <li><strong>Base (B):</strong> { $base }}</li>
            <li><strong>Espesor (e):</strong> { $espesor }}</li>
        </ul>
    </div>
    <div class="recomendacion-pinturas">
        <h3>Recomendación de pinturas</h3>
        <table width="100%">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Ensayo</th>
                    <th>Número de ensayo</th>
                    <th>Espesor mínimo recomendado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filedata as $filedatum)
                <tr>
                    
                    <td>{{ $filedatum->pintura }}</td> 
                    <td>{{ $filedatum->modelo }}</td> 
                    <td>{{ $filedatum->certificado }}</td>
                    <td>{{ $filedatum->numero }}</td>
                    <td>{{ $filedatum->masividad }}</td>
                    <td>{{ $filedatum->m15 }}</td>
                    <!--td>{ $filedatum->m30 }}</td>
                    <td>{ $filedatum->m60 }}</td>
                    <td>{ $filedatum->m90 }}</td>
                    <td>{ $pintura['esp_min_recomendado'] }}</td-->
                </tr>
                @endforeach
            </tbody>
        </table>
        <table width="100%">
            <tr>
                <td valign="top"><img src="/../assets/img/logoEntumescenteB.png"/></td>
                <td align="right">
                    <h3>Shinra Electric power company</h3>
                    <pre>
                        Company representative name
                        Company address
                        Tax ID
                        phone
                        fax
                    </pre>
                </td>
            </tr>
        
          </table>
        
          <table width="100%">
            <tr>
                <td><strong>From:</strong> Linblum - Barrio teatral</td>
                <td><strong>To:</strong> Linblum - Barrio Comercial</td>
            </tr>
        
          </table>
        
          <br/>
        
          <table width="100%">
            <thead style="background-color: lightgray;">
              <tr>
                <th>#</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Unit Price $</th>
                <th>Total $</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Playstation IV - Black</td>
                <td align="right">1</td>
                <td align="right">1400.00</td>
                <td align="right">1400.00</td>
              </tr>
              <tr>
                  <th scope="row">1</th>
                  <td>Metal Gear Solid - Phantom</td>
                  <td align="right">1</td>
                  <td align="right">105.00</td>
                  <td align="right">105.00</td>
              </tr>
              <tr>
                  <th scope="row">1</th>
                  <td>Final Fantasy XV - Game</td>
                  <td align="right">1</td>
                  <td align="right">130.00</td>
                  <td align="right">130.00</td>
              </tr>
            </tbody>
        
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Subtotal $</td>
                    <td align="right">1635.00</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Tax $</td>
                    <td align="right">294.3</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td align="right">Total $</td>
                    <td align="right" class="gray">$ 1929.3</td>
                </tr>
            </tfoot>
          </table>
        
    </div>
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
</body>
</html>