<div>
    <div class="container-fluid py-4">
        <div class="card mb-4 border shadow">
            <div class="card-header pb-0 pr-3">
                <h6>Proyectos</h6>
            </div>
            <div class="card-body pt-0 pb-2 ">
                <div class="table-responsive ">
                    <table class="table align-items-center  ">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1 fw-bold">
                                        <div>
                                            <a href="{{ route('project.create') }}"><img src="{{ asset('/img/icons/crear.png') }}"
                                                    class="avatar avatar-sm me-3 ">Agregar Nuevo Proyecto</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center ">
                                    <form action="{{ route('project.create') }}" method="get">
                                        <button style="width: 200px;" type="submit"
                                            class="btn bg-gradient-info m-1 ms-auto">Agragar Nuevo Proyecto</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1 fw-bold">
                                        <div>
                                            <a href="{{ route('projectProfile.create') }}"><img
                                                    src="{{ asset('/img/icons/crear.png') }}" class="avatar avatar-sm me-3 ">Agregar
                                                Nuevo Perfil</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center ">
                                    <form action="{{ route('projectProfile.create') }}" method="get">
                                        <button style="width: 200px;" type="submit"
                                            class="btn bg-gradient-info m-1 ms-auto">Agregar Nuevo Perfil</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                @if ($user->profile_count > 0)
                                    <div class="alert alert-info text-white">
                                        Tienes {{ $user->profile_count }} Perfiles Disponibles para tus Proyectos.
                                    </div>
                                    <!-- Aquí puedes mostrar información adicional sobre los perfiles -->
                                @else
                                    <div class="alert alert-warning text-white">
                                        No tienes perfiles disponibles. Debes agregar nuevos antes de crear el proyecto.
                                    </div>
                                @endif
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
                        <h6>Proyectos Creados por {{ auth()->user()->username }}</h6> 
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
                                        wire:click="order('projects.id')">
                                        ID
                                        @if ($sort == 'projects.id')
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
                                        wire:click="order('projects.project')">
                                        Nombre del Proyecto
                                        @if ($sort == 'projects.project')
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
                                        wire:click="order('projects.description')">
                                        Descripción
                                        @if ($sort == 'projects.description')
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
                                        class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                        wire:click="order('projects.updated_at')">
                                        Actualizado
                                        @if ($sort == 'projects.updated_at')
                                            @if ($direction == 'asc')
                                                <i class="fas fa-sort-up float-right"></i>
                                            @else
                                                <i class="fas fa-sort-down float-right"></i>
                                            @endif
                                        @else
                                            <i class="fas fa-sort float-right"></i>
                                        @endif
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
                                            <p class="text-sm font-weight-bold mb-0">{{ $project->project }}</p>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ substr($project->description, 0, 50) }}...
                                            </p>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $project->updated_at ? $project->updated_at->diffForHumans() : '' }}
                                            </p>
                                        </td>
                                        <td width="10px" class="align-middle">
                                            <div class="d-flex ">
                                                <form action="{{ route('project.show', $project) }}"
                                                    method="get">
                                                    <button type="submit" class="btn bg-gradient-info m-1">
                                                        Ver Proyecto</button>
                                                </form>
                                                <form id="borrarProject{{ $project->id }}"
                                                    action="{{ route('project.destroy', $project) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button type="button" class="btn bg-gradient-danger m-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalProject{{ $project->id }}">
                                                    Eliminar
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade " id="modalProject{{ $project->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-gradient-danger ">
                                                                <h1 class="modal-title fs-5 text-white">
                                                                    Confirmar Borrado del Proyecto</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body text-center ">
                                                                <p >¿Estás seguro de que deseas eliminar
                                                                    {{ $project->nombre }}?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal" data-bs-toggle="modal"
                                                                    data-bs-target="#borrarProject{{ $project->id }}"
                                                                    onclick="event.preventDefault(); document.getElementById('borrarProject{{ $project->id }}').submit();">
                                                                    Eliminar
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
