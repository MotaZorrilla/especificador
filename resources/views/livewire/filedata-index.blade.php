<div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Base de Datos</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0"> 
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="/img/icons/import.png" class="avatar avatar-sm me-3">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Importar Tablas</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <form action="{{ route('filedata.Import')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <button style="width: 150px;"  type="submit" class="btn bg-gradient-success m-1">Importar</button>
                                                    <input type="file" name="filedata" accept=".xlsx">
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <a href="{{route('filedata.Export')}}"><img src="/img/icons/export.png" class="avatar avatar-sm me-3"></a>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Exportar Tablas</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center ">
                                                <form action="{{route('filedata.Export')}}" method="get" >
                                                    <button style="width: 150px;" type="submit" class="btn bg-gradient-info m-1">Exportar</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <a href="{{route('filedata.create')}}"><img src="/img/icons/crear.png" class="avatar avatar-sm me-3"></a>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Crear Nuevo Registro</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center ">
                                                <form action="{{route('filedata.create')}}" method="get" >
                                                    <button style="width: 150px;" type="submit" class="btn bg-gradient-info m-1">Crear</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <a href=#><img src="/img/icons/ordenar.png" class="avatar avatar-sm me-3"></a>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Ordenar base de datos de Pinturas</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center ">
                                                <form action="{{route('filedata.Order')}}" method="Post" >
                                                    @csrf
                                                    <button style="width: 150px;" id="btnOrdenarBD" type="submit" class="btn bg-gradient-info m-1">Ordenar BD</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <a href=#><img src="/img/icons/borrar-archivo.png" class="avatar avatar-sm me-3"></a>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Borrar base de datos de Pinturas</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center ">
                                                <button style="width: 150px;" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#borrarBase">
                                                    Borrar BD
                                                </button>
    
                                                <!-- Modal -->
                                                <div class="modal fade" id="borrarBase" tabindex="-1" aria-labelledby="borrarBaseLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-gradient-danger ">
                                                                <h1 class="modal-title fs-5 text-white" id="ModalLabel">Confirmar Borrado de Base de Datos</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-left">
                                                                <p>¿Estás seguro de que deseas borrar todos los registros <br>de la Base de datos?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" data-bs-toggle="form" data-bs-target="#borrarForm" id="confirmarBorrar" 
                                                                onclick="event.preventDefault(); document.getElementById('borrarForm').submit();">
                                                                    Borrar BD
                                                                </button>
                                                                <form id="borrarForm" action="{{ route('filedata.Reset') }}" method="POST" >
                                                                    @csrf
                                                                </form>
                                                            </div>
                                                        </div>
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
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0 col-8 mx-auto">
                            <table class="table align-items-center mb-0" style="overflow-x: auto;  table-layout: auto;">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <h6>Usuarios Registrados</h6>

                                            </div>
                                        </td>
                                        <td class="align-middle text-center col-6 ">
                                            <div class="ms-md-auto pe-md-3 d-flex align-items-center ">
                                                <div class="input-group">
                                                    <span class="input-group-text text-body"><i class="fas fa-search"
                                                            aria-hidden="true"></i></span>
                                                    <input wire:model.live="search" class="form-control" id="search"
                                                        placeholder="Buscar...">
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="search-results" class="card-body px-3 pt-0 pb-2">
                        @if ($filedata->count())
                            <div class="table-responsive p-0">
                                <table class="table table-striped " id="usersTable">
                                    <thead>
                                        <tr>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('id')">
                                                ID
                                                @if ($sort == 'id')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('pintura')">
                                                Pintura         
                                                @if ($sort == 'pintura')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('modelo')">
                                                Modelo
                                                @if ($sort == 'modelo')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('certificado')">
                                                Certificado
                                                @if ($sort == 'certificado')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('numero')">
                                                Numero
                                                @if ($sort == 'numero')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('masividad')">
                                                Mas
                                                @if ($sort == 'masividad')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('m15')">
                                                15 M
                                                @if ($sort == 'm15')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('m30')">
                                                30 M
                                                @if ($sort == 'm30')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('m60')">
                                                60 M
                                                @if ($sort == 'm60')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('m90')">
                                                90 M
                                                @if ($sort == 'm90')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                                wire:click="order('m120')">
                                                120 M
                                                @if ($sort == 'm120')
                                                    @if ($direction == 'asc')
                                                        <i class="fas fa-sort-up float-right"> </i>
                                                    @else
                                                        <i class="fas fa-sort-down float-right"> </i>
                                                    @endif
                                                @else
                                                    <i class="fas fa-sort float-right"> </i>
                                                @endif
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                                P4C 
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                                V4C
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                                V3C
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                                Abi
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                                Rec
                                            </th>
                                            <th
                                                class=" text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                                Cir
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($filedata as $filedatum)
                                            <tr>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->id }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->pintura }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->modelo }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->certificado }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->numero }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->masividad }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->m15 }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->m30 }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->m60 }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->m90 }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->m120 }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->p4c }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->v4c }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->v3c }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->abierta }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->rectangular }} </p>                                             
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $filedatum->circular }}</p>
                                                </td>
                                                <td width="10px" class="align-middle ">
                                                    <div class="d-flex ">
                                                        <form action="{{ route('filedata.edit', $filedata) }}" method="get">
                                                            <button type="submit"
                                                                class="btn bg-gradient-info m-1">Editar</button>
                                                        </form>
                                                        <button type="button"
                                                            class="btn bg-gradient-danger m-1">Borrar</button>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {{ $filedata->links() }}
                                </div>
                            </div>
                        @else
                            <div>
                                <div class="alert alert-warning text-white">
                                    No hay datos que coincidan.
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

