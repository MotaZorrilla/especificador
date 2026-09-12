<div>
    <div class="container-fluid py-3 ">
        <!-- Banner Técnico v2.0 Enterprise -->
        <div class="card mb-3 shadow border" style="background: linear-gradient(310deg, #0f172a 0%, #1e293b 100%); border-radius: 12px;">
            <div class="card-body p-3 d-flex flex-wrap justify-content-between align-items-center text-white">
                <div class="d-flex align-items-center">
                    <div class="p-2 me-3 rounded" style="background: rgba(234, 88, 12, 0.2); border: 1px solid #ea580c;">
                        <i class="fas fa-fire-extinguisher text-warning fs-4"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <h6 class="mb-0 text-white font-weight-bold">Base de Datos Técnica de Pinturas & Recubrimientos</h6>
                            <span class="badge bg-gradient-warning text-xxs font-weight-bolder">v2.0 Enterprise</span>
                        </div>
                        <p class="mb-0 text-xs text-slate-300 opacity-8">Especificación de masividades y retardos térmicos (NCh3040 / OGUC Chile)</p>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-2 mt-md-0">
                    <span class="badge bg-dark border border-secondary text-xs px-3 py-2">
                        <i class="fas fa-shield-alt text-success me-1"></i> Dispositivo Único Vinculado &bull; Cálculos Ilimitados
                    </span>
                </div>
            </div>
        </div>

        <div class="card mb-4 shadow border" style="border-radius: 12px;">
            <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                <h6 class="font-weight-bolder mb-0 text-slate-800">
                    <i class="fas fa-tools text-primary me-2"></i> Operaciones de Base de Datos
                </h6>
                <span class="text-xs text-muted">Gestión segura de planillas técnicas</span>
            </div>
            <div class="card-body px-0 pt-2 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <tbody>
                            <!-- Importar -->
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-2">
                                        <div class="me-3">
                                            <img src="{{ asset('/img/icons/import.png') }}" class="avatar avatar-sm">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm font-weight-bold">Importar Planilla Técnica</h6>
                                            <span class="text-xxs text-muted">Carga masiva tolerante a fallos (.xlsx, .xls, .csv - máx 25MB)</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-end pe-4">
                                    <form action="{{ route('filedata.Import') }}" method="post" enctype="multipart/form-data" id="importForm" class="d-flex align-items-center justify-content-end gap-2">
                                        @csrf
                                        <input type="file" name="filedata" accept=".xlsx, .xls, .csv" class="form-control form-control-sm text-xs" style="max-width: 260px;" required>
                                        <button 
                                            style="min-width: 140px;" 
                                            type="submit" 
                                            class="btn bg-gradient-success btn-sm m-0 font-weight-bold"
                                            id="btnImportar">
                                            <i class="fas fa-file-import me-1"></i> Importar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Exportar -->
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-2">
                                        <div class="me-3">
                                            <a href="{{ route('filedata.Export') }}">
                                                <img src="{{ asset('/img/icons/export.png') }}" class="avatar avatar-sm">
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm font-weight-bold">Exportar Tablas de Pinturas</h6>
                                            <span class="text-xxs text-muted">Descarga completa del dataset en formato Excel oficial</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-end pe-4">
                                    <form action="{{ route('filedata.Export') }}" method="get">
                                        <button style="min-width: 140px;" type="submit" class="btn bg-gradient-info btn-sm m-0 font-weight-bold">
                                            <i class="fas fa-file-excel me-1"></i> Exportar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Crear Registro -->
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-2">
                                        <div class="me-3">
                                            <a href="{{ route('filedata.create') }}">
                                                <img src="{{ asset('/img/icons/crear.png') }}" class="avatar avatar-sm">
                                            </a>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm font-weight-bold">Nuevo Registro Técnico</h6>
                                            <span class="text-xxs text-muted">Ingreso individual de pintura, certificación y factores F15-F120</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-end pe-4">
                                    <form action="{{ route('filedata.create') }}" method="get">
                                        <button style="min-width: 140px;" type="submit" class="btn bg-gradient-primary btn-sm m-0 font-weight-bold">
                                            <i class="fas fa-plus-circle me-1"></i> Crear Registro
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Ordenar BD -->
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-2">
                                        <div class="me-3">
                                            <img src="{{ asset('/img/icons/ordenar.png') }}" class="avatar avatar-sm">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm font-weight-bold">Reordenar Base de Datos</h6>
                                            <span class="text-xxs text-muted">Reorganizar marcas y correlativos de aparición en cálculos</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-end pe-4">
                                    <button style="min-width: 140px;" type="button" class="btn bg-gradient-secondary btn-sm m-0 font-weight-bold" data-bs-toggle="modal" data-bs-target="#ordenarBaseModal">
                                        <i class="fas fa-sort-numeric-down me-1"></i> Ordenar BD
                                    </button>

                                    <!-- Modal Ordenar -->
                                    <div class="modal fade" id="ordenarBaseModal" tabindex="-1" aria-labelledby="ordenarBaseLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-gradient-secondary text-white">
                                                    <h6 class="modal-title text-white font-weight-bold" id="ordenarBaseLabel">
                                                        <i class="fas fa-sort me-2"></i> Reordenar Marcas de Pintura
                                                    </h6>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p class="mb-0 text-sm">Se recalculará la secuencia correlativa de marcas para las listas desplegables del especificador. ¿Deseas continuar?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                    <form action="{{ route('filedata.Order') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn bg-gradient-primary btn-sm">Confirmar Orden</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <!-- Borrar BD -->
                            <tr>
                                <td>
                                    <div class="d-flex px-3 py-2">
                                        <div class="me-3">
                                            <img src="{{ asset('/img/icons/borrar-archivo.png') }}" class="avatar avatar-sm">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm font-weight-bold text-danger">Resetear Base de Datos</h6>
                                            <span class="text-xxs text-muted">Acción destructiva: vacía todos los registros de pinturas y certificados</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-end pe-4">
                                    <button style="min-width: 140px;" type="button" class="btn btn-outline-danger btn-sm m-0 font-weight-bold" data-bs-toggle="modal" data-bs-target="#borrarBase">
                                        <i class="fas fa-trash-alt me-1"></i> Borrar BD
                                    </button>

                                    <!-- Modal Borrar -->
                                    <div class="modal fade" id="borrarBase" tabindex="-1" aria-labelledby="borrarBaseLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-gradient-danger">
                                                    <h6 class="modal-title text-white font-weight-bold" id="ModalLabel">
                                                        <i class="fas fa-exclamation-triangle me-2"></i> Confirmar Reseteo Total
                                                    </h6>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
                                                </div>
                                                <div class="modal-body text-start">
                                                    <p class="text-sm mb-2 text-dark font-weight-bold">¿Estás seguro de que deseas vaciar todos los registros técnicos?</p>
                                                    <p class="text-xs text-muted mb-0">Esta acción eliminará todas las pinturas importadas y sus factores de masividad. Deberás volver a importar una planilla.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                    <form id="borrarForm" action="{{ route('filedata.Reset') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn bg-gradient-danger btn-sm">Confirmar Borrado</button>
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
    <div class="card mb-4 mx-3 shadow border">

        @include('components.alert')
        <div class="card-header px-0 pt-0 pb-2">
            <div class="table-responsive p-0 col-8 mx-auto">
                <table class="table align-items-center mb-0" style="overflow-x: auto;  table-layout: auto;">
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <h6>Registro de Pinturas</h6>

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
        @if ($filedata->count())
            <div class="card-body px-3 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table table-striped " id="usersTable">
                        <thead>
                            <tr>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('id')">
                                    ID
                                    @if ($sort == 'id')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "></i>
                                        @else
                                            <i class="bi bi-caret-down-fill "></i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "></i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('pintura')">
                                    Pintura
                                    @if ($sort == 'pintura')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "></i>
                                        @else
                                            <i class="bi bi-caret-down-fill "></i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "></i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('modelo')">
                                    Modelo
                                    @if ($sort == 'modelo')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "></i>
                                        @else
                                            <i class="bi bi-caret-down-fill "></i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "></i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('certificado')">
                                    Certificado
                                    @if ($sort == 'certificado')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "></i>
                                        @else
                                            <i class="bi bi-caret-down-fill "></i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "></i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('numero')">
                                    Numero
                                    @if ($sort == 'numero')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "></i>
                                        @else
                                            <i class="bi bi-caret-down-fill "></i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "></i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('masividad')">
                                    Mas
                                    @if ($sort == 'masividad')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "></i>
                                        @else
                                            <i class="bi bi-caret-down-fill "></i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "></i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('m15')">
                                    15 M
                                    @if ($sort == 'm15')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "> </i>
                                        @else
                                            <i class="bi bi-caret-down-fill "> </i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "> </i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('m30')">
                                    30 M
                                    @if ($sort == 'm30')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "> </i>
                                        @else
                                            <i class="bi bi-caret-down-fill "> </i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "> </i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('m60')">
                                    60 M
                                    @if ($sort == 'm60')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "> </i>
                                        @else
                                            <i class="bi bi-caret-down-fill "> </i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "> </i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('m90')">
                                    90 M
                                    @if ($sort == 'm90')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "> </i>
                                        @else
                                            <i class="bi bi-caret-down-fill "> </i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "> </i>
                                    @endif
                                </th>
                                <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                    wire:click="order('m120')">
                                    120 M
                                    @if ($sort == 'm120')
                                        @if ($direction == 'asc')
                                            <i class="bi bi-caret-up-fill "> </i>
                                        @else
                                            <i class="bi bi-caret-down-fill "> </i>
                                        @endif
                                    @else
                                        <i class="bi bi-list "> </i>
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
                                        <p class="text-sm font-weight-bold mb-0">{{ $filedatum->pintura }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">{{ $filedatum->modelo }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $filedatum->certificado }}</p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">{{ $filedatum->numero }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $filedatum->masividad }}</p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">{{ substr($filedatum->m15, 0, 5) }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">{{ substr($filedatum->m30, 0, 5) }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">{{ substr($filedatum->m60, 0, 5) }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">{{ substr($filedatum->m90, 0, 5) }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">{{ substr($filedatum->m120, 0, 5) }}
                                        </p>
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
                                        <p class="text-sm font-weight-bold mb-0">{{ $filedatum->abierta }}
                                        </p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $filedatum->rectangular }} </p>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $filedatum->circular }}</p>
                                    </td>
                                    <td width="10px" class="align-middle ">
                                        <div class="d-flex ">
                                            <form action="{{ route('filedata.edit', $filedatum) }}" method="get">
                                                <button type="submit"
                                                    class="btn bg-gradient-info m-1">Editar</button>
                                            </form>
                                            <form id="borrarFiledata{{ $filedatum->id }}"
                                                action="{{ route('filedata.destroy', $filedatum) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            <button type="button" class="btn bg-gradient-danger m-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalFiledata{{ $filedatum->id }}">
                                                Eliminar
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalFiledata{{ $filedatum->id }}" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-gradient-danger ">
                                                            <h1 class="modal-title fs-5 text-white">
                                                                Confirmar Borrado de Registro</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <p>¿Estás seguro de que deseas eliminar <br>
                                                                {{ $filedatum->pintura }} masividad: {{ $filedatum->masividad }}?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-info"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal" data-bs-toggle="modal"
                                                                data-bs-target="#borrarFiledata{{ $filedatum->id }}"
                                                                onclick="event.preventDefault(); document.getElementById('borrarFiledata{{ $filedatum->id }}').submit();">
                                                                Borrar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer pb-0">
                        {{ $filedata->links() }}
                    </div>
                </div>
            @else
                <div>
                    <div class="alert alert-warning text-white mx-3">
                        No hay datos que coincidan.
                    </div>
                </div>
        @endif

    </div>
</div>

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('importForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const btn = document.getElementById('btnImportar');
                if (btn) {
                    btn.innerHTML = `
                        <span class="spinner-border spinner-border-sm" role="status"></span>
                        Importando...
                    `;
                    btn.disabled = true;
                }
            });
        }
    });
</script>
@endsection