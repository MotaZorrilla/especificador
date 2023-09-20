<div>
    <div class="container-fluid py-4">
        <div class="card mb-4 border shadow">
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
                                        <div>
                                            <a href="{{ route('projectAdmin.create') }}"><img src="/img/icons/export.png"
                                                    class="avatar avatar-sm me-3"></a>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">Crear Nuevo Proyecto</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-right ">
                                    <form action="{{ route('projectAdmin.create') }}" method="get">

                                        <button type="submit" class="btn bg-gradient-info m-1">Crear</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4 border shadow">
            @include('components.alert')
            <div class="card-header px-auto pt-3 ">
                <div class="d-flex d-inline ">
                    <div class="col-6">
                        <h6>Proyectos Creados</h6>
                    </div>
                    <div class="input-group ">
                        <span class="input-group-text text-body">
                            <i class="fas fa-search"></i></span>
                        <input wire:model.live="search" class="form-control" id="search" placeholder="Buscar...">
                    </div>
                </div>
            </div>
            @if ($projects->count())
                <div class="card-body px-3 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-striped ">
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
                                        wire:click="order('nombre')">
                                        Nombre del Proyecto
                                        @if ($sort == 'nombre')
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
                                        wire:click="order('descripcion')">
                                        Descripción
                                        @if ($sort == 'descripcion')
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
                                        class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                        Actualizado
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                        Acción
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">{{ $project->id }}</p>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">{{ $project->nombre }}</p>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ substr($project->descripcion, 0, 50) }}...</p>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $project->updated_at ? $project->updated_at->diffForHumans() : '' }}
                                            </p>
                                        </td>
                                        <td width="10px" class="align-middle">
                                            <div class="d-flex ">
                                                <form action="{{ route('projectAdmin.show', $project) }}"
                                                    method="get">
                                                    <button type="submit" class="btn bg-gradient-info m-1">Ver
                                                        Proyecto</button>
                                                </form>
                                                <button type="button" class="btn bg-gradient-danger m-1"
                                                    data-bs-toggle="modal" data-bs-target="#modal">
                                                    Eliminar
                                                </button>
                                                @include('components.modal', [
                                                    'title'     => 'Confirmar Borrado del Proyecto',
                                                    'body'      => '¿Estás seguro de que deseas borrar el proyecto?',
                                                    'button'    => 'Borrar',
                                                    'form'      => 'borrarProyecto',
                                                    'route'     => 'projectAdmin.destroy',
                                                    'id'        => $project
                                                ])
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer pb-0">
                            {{ $projects->links() }}
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-warning text-white mx-3">
                    No hay datos que coincidan.
                </div>
            @endif
        </div>
    </div>
</div>
