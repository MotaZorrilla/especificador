@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos | Administradores | Crear'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Proyectos</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0"> 
                                <tbody> 
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Crear Nuevo Proyecto</h6>
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
                            <form action="{{ route('projectAdmin.store')}}" method="post" >
                                @csrf
                                @if (Session::has('message'))
                                    <p>{{ Session::get('messsage')}}</p>
                                @endif
                                <div>
                                    <h3>Crear un Nuevo Proyecto</h3>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="nombre" >Nombre del Proyecto:</label>
                                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Escribe el nombre de tu Proyecto" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="descripcion" >Descripción:</label>
                                    <textarea class="form-control" type="text" id="descripcion" name="descripcion" placeholder="Escribe la descripción de tu Proyecto"></textarea>
                                </div>
                                {{-- conozco masividad --}}
                                <div class="form-group">
                                    <label class="form-control-label">¿Conozco la Masividad?:</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="conozco_masividad" name="conozco_masividad" checked="">
                                        <label class="form-check-label" for="conozco_masividad">Si, Conozco la Masividad</label>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="conozco_masividad_no" name="conozco_masividad_no" >
                                        <label class="form-check-label" for="conozco_masividad_no">No, no Conozco la Masividad</label>
                                    </div>
                                </div>
                                {{-- Formulario si conozco la masividad --}}
                                <div id="form_masividad" name="form_masividad" style= "display: block">
                                    <div class="form-group">
                                        <label class="form-control-label">Tipo Perfil:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="abierto" id="perfil_A" name="perfil_A" checked="">
                                            <label class="custom-control-label" for="perfil_A">Perfil Abierto</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="cerrado" id="perfil_B" name="perfil_B">
                                            <label class="custom-control-label" for="perfil_B">Perfil Cerrado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="masividad" class="form-control-label">Masividad:</label>
                                        <input class="form-control" type="number" id="masividad" name="masividad" placeholder="Escribe la masividad de tu proyecto" required>
                                    </div>  
                                </div>    
                                {{-- Formulario desconozco la masividad --}}
                                <div id="form_masividad_no" name="form_masividad_no" style= "display: none" >
                                    <div class="form-grou">
                                        <label class="form-control-label">Tipo Perfil:</label>
                                        <br/>
                                        <div class="row">
                                            {{-- Tipo de Viga --}}
                                            <div style="display: inline-block; vertical-align: top;" class="col-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Viga3" id="Viga3" name="Viga3" checked="">
                                                    <label class="custom-control-label" for="Viga3">Viga 3 Caras</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Viga4" id="Viga4" name="Viga4">
                                                    <label class="custom-control-label" for="Viga4">Pilar y Viga 4 Caras</label>
                                                </div>
                                            </div>
                                            {{-- forma del perfil --}}
                                            <div style="display: inline-block; vertical-align: top; " class="col-4" >
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_HSR" name="perfil_HSR" checked="">
                                                    <label class="custom-control-label" for="perfil_HSR">H Sin Radio</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_HCR" name="perfil_HCR">
                                                    <label class="custom-control-label" for="perfil_HCR">H Con Radio</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_R" name="perfil_R" >
                                                    <label class="custom-control-label" for="perfil_R">Rectangular</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_O" name="perfil_O">
                                                    <label class="custom-control-label" for="perfil_O">Circular</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_C" name="perfil_C" >
                                                    <label class="custom-control-label" for="perfil_C">C</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_IC" name="perfil_IC">
                                                    <label class="custom-control-label" for="perfil_IC">IC</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_CA" name="perfil_CA" >
                                                    <label class="custom-control-label" for="perfil_CA">CA</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_ICA" name="perfil_ICA">
                                                    <label class="custom-control-label" for="perfil_ICA">ICA</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_OCA" name="perfil_OCA">
                                                    <label class="custom-control-label" for="perfil_OCA">OCA</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_L" name="perfil_L" >
                                                    <label class="custom-control-label" for="perfil_L">L</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_Z" name="perfil_Z">
                                                    <label class="custom-control-label" for="perfil_Z">Z</label>
                                                </div>
                                            </div>
                                            {{-- imagen del perfil --}}
                                            <div style="display: inline-block; vertical-align: top; " class="col-4" >
                                                <div>
                                                    <img id="img" src="/../assets/img/Cortes/H.png" style="max-width: 100% ">
                                                </div>
                                                {{-- datos --}}
                                                <div class="form-group">
                                                    <label class="form-control-label" for="h">Altura:</label>
                                                    <input class="form-control" type="text" id="h" name="h" placeholder="H (mm)" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="b1">Base:</label>
                                                    <input class="form-control" type="text" id="b1" name="b1" placeholder="B1 (mm)" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for="b2">Nombre del Proyecto:</label>
                                                    <input class="form-control" type="text" id="b2" name="b2" placeholder="B2 (mm)" required>
                                                </div>
                                                <div class="form-group">
                                                    {{-- <label class="form-control-label" for=>Nombre del Proyecto:</label> --}}
                                                    <input class="form-control" type="text" id="C" name="C" placeholder="C (mm)" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for=>Nombre del Proyecto:</label>
                                                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Escribe el nombre de tu Proyecto" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for=>Nombre del Proyecto:</label>
                                                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Escribe el nombre de tu Proyecto" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for=>Nombre del Proyecto:</label>
                                                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Escribe el nombre de tu Proyecto" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for=>Nombre del Proyecto:</label>
                                                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Escribe el nombre de tu Proyecto" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-control-label" for=>Nombre del Proyecto:</label>
                                                    <input class="form-control" type="text" id="nombre" name="nombre" placeholder="Escribe el nombre de tu Proyecto" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                </div> 
                                {{-- resistencia   --}}
                                <div class="form-group">
                                    <label for="resistencia" class="form-control-label">Resistencia al Fuego:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="resistencia_15" name="resistencia" value="15" checked="">
                                        <label class="form-check-label" for="resistencia_15">15 minutos</label>
                                    </div>
                                    <div class="form-check" style="display: inline-block;">
                                        <input class="form-check-input" type="checkbox" id="resistencia_30" name="resistencia" value="30">
                                        <label class="form-check-label" for="resistencia_30">30 minutos</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="resistencia_60" name="resistencia" value="60">
                                        <label class="form-check-label" for="resistencia_60">60 minutos</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="resistencia_90" name="resistencia" value="90">
                                        <label class="form-check-label" for="resistencia_90">90 minutos</label>
                                    </div>
                                </div>
                                {{-- boton --}}
                                <div class="d-flex ">
                                    <div>
                                        <button type="submit" class="btn bg-gradient-info m-1">Crear</button>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex ">
                                <form action="{{ route('projectAdmin.index') }}" method="get" >
                                    <button type="submit" class="btn bg-gradient-danger m-1">Volver</button>
                                </form>
                            </div>    
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    @include('layouts.footers.footer')
@endsection

@section('js')
<script>
        //habilitar la casilla de masividad
        document.getElementById("conozco_masividad").addEventListener("change", function(){
            if(this.checked){
                document.getElementById("form_masividad").style.display = "block";
                document.getElementById("form_masividad_no").style.display = "none";
                document.getElementById("conozco_masividad_no").checked=false;
            }else{
                document.getElementById("form_masividad").style.display = "none";
                document.getElementById("form_masividad_no").style.display = "block";
                document.getElementById("conozco_masividad_no").checked=true;
            }
        });
        document.getElementById("conozco_masividad_no").addEventListener("change", function(){
            if(this.checked){
                document.getElementById("form_masividad").style.display = "none";
                document.getElementById("form_masividad_no").style.display = "block";
                document.getElementById("conozco_masividad").checked=false;
            }else{
                document.getElementById("form_masividad").style.display = "block";
                document.getElementById("form_masividad_no").style.display = "none";
                document.getElementById("conozco_masividad").checked=true;
            }
        });

        //selecionar solo un tipo de perfil CON MASIVIDAD
        document.getElementById("perfil_A").addEventListener("change", function(){
            if(this.checked){
                document.getElementById("perfil_B").checked=false;
            }else{
                document.getElementById("perfil_B").checked=true;
            }
        });
        document.getElementById("perfil_B").addEventListener("change", function(){
            if(this.checked){
                document.getElementById("perfil_A").checked=false;
            }else{
                document.getElementById("perfil_A").checked=true;
            }
        });

        //selecionar solo un tipo de perfil SIN MASIVIDAD
        document.getElementById("Viga3").addEventListener("change", function(){
            if(this.checked){
                document.getElementById("Viga4").checked=false;
            }else{
                document.getElementById("Viga4").checked=true;
            }
        });
        document.getElementById("Viga4").addEventListener("change", function(){
            if(this.checked){
                document.getElementById("Viga3").checked=false;
            }else{
                document.getElementById("Viga3").checked=true;
            }
        });

        //selecionar solo un tipo de resistencia
        document.getElementById("resistencia_15").addEventListener("change", function(){resistencia("resistencia_15");});
        document.getElementById("resistencia_30").addEventListener("change", function(){resistencia("resistencia_30");});
        document.getElementById("resistencia_60").addEventListener("change", function(){resistencia("resistencia_60");});
        document.getElementById("resistencia_90").addEventListener("change", function(){resistencia("resistencia_90");});

        function resistencia(Resistencia) {
            document.getElementById("resistencia_15").checked = false;
            document.getElementById("resistencia_30").checked = false;
            document.getElementById("resistencia_60").checked = false;
            document.getElementById("resistencia_90").checked = false;
            switch(Resistencia) {
                case "resistencia_15":  document.getElementById("resistencia_15").checked = true;   break;
                case "resistencia_30":  document.getElementById("resistencia_30").checked = true;   break;
                case "resistencia_60":  document.getElementById("resistencia_60").checked = true;   break;
                case "resistencia_90":  document.getElementById("resistencia_90").checked = true;   break;
                default:                                                                            break;
            };
        };

        //selecionar solo un tipo de perfil
        document.getElementById("perfil_HSR").addEventListener("change", function(){perfil("perfil_HSR");});
        document.getElementById("perfil_HCR").addEventListener("change", function(){perfil("perfil_HCR");});
        document.getElementById("perfil_R"  ).addEventListener("change", function(){perfil("perfil_R");});
        document.getElementById("perfil_O"  ).addEventListener("change", function(){perfil("perfil_O");});
        document.getElementById("perfil_C"  ).addEventListener("change", function(){perfil("perfil_C");});
        document.getElementById("perfil_IC" ).addEventListener("change", function(){perfil("perfil_IC");});
        document.getElementById("perfil_CA" ).addEventListener("change", function(){perfil("perfil_CA");});
        document.getElementById("perfil_ICA").addEventListener("change", function(){perfil("perfil_ICA");});
        document.getElementById("perfil_OCA").addEventListener("change", function(){perfil("perfil_OCA");});
        document.getElementById("perfil_L"  ).addEventListener("change", function(){perfil("perfil_L");});
        document.getElementById("perfil_Z"  ).addEventListener("change", function(){perfil("perfil_Z");});
        
        function perfil(perfil) {
            document.getElementById("perfil_HSR").checked = false;
            document.getElementById("perfil_HCR").checked = false;
            document.getElementById("perfil_R"  ).checked = false;
            document.getElementById("perfil_O"  ).checked = false;
            document.getElementById("perfil_C"  ).checked = false;
            document.getElementById("perfil_IC" ).checked = false;
            document.getElementById("perfil_CA" ).checked = false;
            document.getElementById("perfil_ICA").checked = false;
            document.getElementById("perfil_OCA").checked = false;
            document.getElementById("perfil_L"  ).checked = false;
            document.getElementById("perfil_Z"  ).checked = false;
            switch(perfil) {
                case "perfil_HSR": document.getElementById("perfil_HSR").checked = true;   document.getElementById("img").src="/../assets/img/Cortes/H.png";   break;
                case "perfil_HCR": document.getElementById("perfil_HCR").checked = true;   document.getElementById("img").src="/../assets/img/Cortes/H.png";   break;
                case "perfil_R":   document.getElementById("perfil_R"  ).checked = true;   document.getElementById("img").src="/../assets/img/Cortes/R.png";   break;
                case "perfil_O":   document.getElementById("perfil_O"  ).checked = true;   document.getElementById("img").src="/../assets/img/Cortes/O.png";   break;
                case "perfil_C":   document.getElementById("perfil_C"  ).checked = true;   document.getElementById("img").src="/../assets/img/Cortes/C.png";   break;
                case "perfil_IC":  document.getElementById("perfil_IC" ).checked = true;   document.getElementById("img").src="/../assets/img/Cortes/IC.png";  break;
                case "perfil_CA":  document.getElementById("perfil_CA" ).checked = true;   document.getElementById("img").src="/../assets/img/Cortes/CA.png";  break;
                case "perfil_ICA": document.getElementById("perfil_ICA").checked = true;   document.getElementById("img").src="/../assets/img/Cortes/ICA.png"; break;
                case "perfil_OCA": document.getElementById("perfil_OCA").checked = true;   document.getElementById("img").src="/../assets/img/Cortes/OCA.png"; break;
                case "perfil_L":   document.getElementById("perfil_L"  ).checked = true;   document.getElementById("img").src="/../assets/img/Cortes/L.png";   break;
                case "perfil_Z":   document.getElementById("perfil_Z"  ).checked = true;   document.getElementById("img").src="/../assets/img/Cortes/Z.png";   break;
                default:                                                                                                                                       break;
            }
        };
</script>
@endsection