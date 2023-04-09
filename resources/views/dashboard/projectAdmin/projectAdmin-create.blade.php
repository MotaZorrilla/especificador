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
                                            <input class="form-check-input" type="checkbox" value="Perfil Abierto"                  id="perfil_A" name="perfil" checked="">
                                            <label class="custom-control-label" for="perfil_A">Abierto</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="Perfil Cerrado"                  id="perfil_B" name="perfil">
                                            <label class="custom-control-label" for="perfil_B">Cerrado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="masividad" class="form-control-label">Masividad:</label>
                                        <input class="form-control" type="number" id="masividad" name="masividad" placeholder="Escribe la masividad de tu proyecto" required >
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
                                                    <input class="form-check-input" type="checkbox" value="Viga 3 Caras"            id="perfil_3" name="perfil" >
                                                    <label class="custom-control-label" for="perfil_3">Viga 3 Caras</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="Pilar y Viga 4 Caras"    id="perfil_4" name="perfil">
                                                    <label class="custom-control-label" for="perfil_4">Pilar y Viga 4 Caras</label>
                                                </div>
                                            </div>
                                            {{-- forma del perfil --}}
                                            <div style="display: inline-block; vertical-align: top; " class="col-4" >
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_HSR" value="Perfil H sin radio"  name="forma">
                                                    <label class="custom-control-label" for="perfil_HSR">H Sin Radio</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_HCR" value="Perfil H con radio"  name="forma">
                                                    <label class="custom-control-label" for="perfil_HCR">H Con Radio</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_R"   value="Perfil Rectangular"  name="forma">
                                                    <label class="custom-control-label" for="perfil_R">Rectangular</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_O"   value="Perfil Circular"     name="forma">
                                                    <label class="custom-control-label" for="perfil_O">Circular</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_C"   value="Perfil C"            name="forma">
                                                    <label class="custom-control-label" for="perfil_C">C</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_IC"  value="Perfil IC"           name="forma">
                                                    <label class="custom-control-label" for="perfil_IC">IC</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_CA"  value="Perfil CA"           name="forma">
                                                    <label class="custom-control-label" for="perfil_CA">CA</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_ICA" value="Perfil ICA"          name="forma">
                                                    <label class="custom-control-label" for="perfil_ICA">ICA</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_OCA" value="Perfil OCA"          name="forma">
                                                    <label class="custom-control-label" for="perfil_OCA">OCA</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_L"   value="Perfil L ó Angulo"   name="forma">
                                                    <label class="custom-control-label" for="perfil_L">L</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="perfil_Z"   value="Perfil Z"            name="forma">
                                                    <label class="custom-control-label" for="perfil_Z">Z</label>
                                                </div>
                                            </div>
                                            {{-- imagen del perfil --}}
                                            <div style="display: inline-block; vertical-align: top; " class="col-4" >
                                                <div>
                                                    <img id="img" src="/../assets/img/Cortes/H.png" style="max-width: 100% ">
                                                </div>
                                                {{-- datos --}}
                                                <div class="form-group" id="d_H">
                                                    <label class="form-control-label" for="dato_H">Altura:</label>
                                                    <input class="form-control" type="number" id="dato_H"  name="dato_H"  placeholder="H (mm)" >
                                                </div>
                                                <div class="form-group" id="d_B1">
                                                    <label class="form-control-label" for="dato_B1">Base:</label>
                                                    <input class="form-control" type="number" id="dato_B1" name="dato_B1" placeholder="B1 (mm)" >
                                                </div>
                                                <div class="form-group" id="d_B2">
                                                    <label class="form-control-label" for="dato_b2">Base 2:</label>
                                                    <input class="form-control" type="number" id="dato_B2" name="dato_B2" placeholder="B2 (mm)" >
                                                </div>
                                                <div class="form-group" id="d_C">
                                                    <label class="form-control-label" for="dato_C">Pieque:</label> 
                                                    <input class="form-control" type="number" id="dato_C"  name="dato_C"  placeholder="C (mm)" >
                                                </div>
                                                <div class="form-group" id="d_e1">
                                                    <label class="form-control-label" for="dato_e1">Espesor:</label>
                                                    <input class="form-control" type="number" id="dato_e1" name="dato_e1" placeholder="e (mm)" >
                                                </div>
                                                <div class="form-group" id="d_e2">
                                                    <label class="form-control-label" for="dato_e2">Espesor e2:</label>
                                                    <input class="form-control" type="number" id="dato_e2" name="dato_e2" placeholder="e2 (mm)" >
                                                </div>
                                                <div class="form-group" id="d_t">
                                                    <label class="form-control-label" for="dato_t">Espesor t:</label>
                                                    <input class="form-control" type="number" id="dato_t"  name="dato_t"  placeholder="t (mm)" >
                                                </div>
                                                <div class="form-group" id="d_r">
                                                    <label class="form-control-label" for=dato_r>Radio:</label>
                                                    <input class="form-control" type="number" id="dato_r"  name="dato_r"  placeholder="r (mm)" >
                                                </div>
                                                <div class="form-group" id="d_D">
                                                    <label class="form-control-label" for="dato_D">Dimetro Exterior:</label>
                                                    <input class="form-control" type="number" id="dato_D"  name="dato_D"  placeholder="H (mm)" >
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
    <script src="/../assets/js/create.js"></script>
@endsection