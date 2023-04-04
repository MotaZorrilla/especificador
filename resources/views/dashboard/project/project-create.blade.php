@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos'])
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
                            <form action="{{ route('project.store')}}" method="post" >
                                @csrf
                                @if (Session::has('message'))
                                    <p>{{ Session::get('messsage')}}</p>
                                @endif
                                
                                <div>
                
                                </div>
                                <div>
                                    <h3>Crear un Nuevo Proyecto</h3>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for=>Nombre del Proyecto:</label>
                                    <input class="form-control" type="text" id="nombre" name="nombre" value="Prueba">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for=>Descripción:</label>
                                    <textarea class="form-control" type="text" id="descripcion" name="descripcion">Escribe la descripción de tu Proyecto</textarea>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">¿Conozco la Masividad?:</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="conozco_masividad" name="conozco_masividad" checked="">
                                        <label class="form-check-label" for="conozco_masividad">Si, Conozco la Masividad</label>
                                    </div>
                                </div>
                                <div id="form_masividad" name="form_masividad">
                                    <div class="form-group">
                                        <label class="form-control-label">Tipo Perfil:</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="abierto" id="open" name="perfil" checked="">
                                            <label class="custom-control-label" for="open">Perfil Abierto</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="cerrado" id="close" name="perfil">
                                            <label class="custom-control-label" for="close">Perfil Cerrado</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="masividad" class="form-control-label">Masividad:</label>
                                        <input class="form-control" type="number" id="masividad" name="masividad" value="171">
                                    </div>
                                    <div class="form-group">
                                        <label for="resistencia" class="form-control-label">Resistencia al Fuego:</label>
                                        <input class="form-control" type="number" id="resistencia" name="resistencia" value="171">
                                    </div>
                                </div>    
                                <div class="d-flex ">
                                    <div>
                                        <button type="submit" class="btn bg-gradient-info m-1">Crear</button>
                                    </div>
                            </form>
                                    <div>
                                        <form action="{{ route('project.index') }}" method="get" >
                                            <button type="submit" class="btn bg-gradient-danger m-1">Volver</button>
                                        </form>
                                    </div>    
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
        //selecionar solo un tipo de perfil
        document.getElementById("open").addEventListener("change", function(){
            if(this.checked) {
                document.getElementById("close").checked = false;
            }
        });
        document.getElementById("close").addEventListener("change", function(){
            if(this.checked) {
                document.getElementById("open").checked = false;
            }
        });
        //habilitar la casilla de masividad
        document.getElementById("conozco_masividad").addEventListener("change", function(){
            if(this.checked){
                document.getElementById("form_masividad").style.display = "block";
            }else{
                document.getElementById("form_masividad").style.display = "none";
            }
        });
</script>

@endsection

