<div>
    <div class="container-fluid py-4">
        <div class="card mb-4 border shadow">
            <div class="card-header pb-0 pr-3">
                <h6>Perfiles</h6>
            </div>
            <div class="card-body pt-0 pb-2 ">
                <div class="table-responsive ">
                    <table class="table align-items-center  ">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1 fw-bold">
                                        <div>
                                            <a href="{{ route('projectProfile.create') }}"><img src="/img/icons/crear.png"
                                                    class="avatar avatar-sm me-3 ">Agregar Nuevo Perfil</a>
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
                                <td>
                                    <div class="d-flex px-2 py-1 fw-bold">
                                        <div>
                                            <a href="{{ route('projectAdminProfile') }}"><img
                                                    src="/img/icons/import.png"
                                                    class="avatar avatar-sm me-3 ">Observaciones</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center ">
                                    <form action="{{ route('projectAdminProfile') }}" method="get">
                                        <button style="width: 200px;" type="submit"
                                            class="btn bg-gradient-success m-1 ms-auto">Observaciones</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1 fw-bold">
                                        <div>
                                            <a href="{{ route('projectAdminProfile') }}"><img
                                                    src="/img/icons/export.png" class="avatar avatar-sm me-3 ">Exportar
                                                Informe a PDF</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center ">
                                    <form action="{{ route('projectAdminProfile') }}" method="get">
                                        <button style="width: 200px;" type="submit"
                                            class="btn bg-gradient-primary m-1 ms-auto">Generar PDF</button>
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
                        <!-- Mostrar el nombre del proyecto -->
                        <h6>Perfiles del Proyecto:
                            {{ $profiles->first() ? $profiles->first()->project : 'Sin perfiles' }}</h6>
                    </div>
                    <div class="input-group ">
                        <span class="input-group-text text-body">
                            <i class="fas fa-search"></i></span>
                        <input wire:model.live="search" class="form-control" id="search" placeholder="Buscar...">
                    </div>
                </div>
            </div>
            @if ($profiles->count())
                <div class="card-body px-3 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-striped ">
                            <thead>
                                <tr>
                                    <th class="cursor-pointer text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2"
                                        wire:click="order('profiles.id')">
                                        ID
                                        @if ($sort == 'profiles.id')
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
                                        wire:click="order('profiles.nombre')">
                                        Perfil
                                        @if ($sort == 'profiles.nombre')
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
                                        wire:click="order('profiles.descripcion')">
                                        descripción
                                        @if ($sort == 'profiles.descripcion')
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
                                        Incluir
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
                                        class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                        Actualizado
                                        @if ($sort == 'profiles.updated_at')
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
                                @foreach ($profiles as $profile)
                                    <tr>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">{{ $profile->id }}</p>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">{{ $profile->nombre }}</p>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ substr($profile->descripcion, 0, 10) }} ...
                                            </p>
                                        </td>
                                        <td class="align-middle">
                                            <input type="checkbox" @if ($profile->incluir) checked @endif
                                                wire:click="included('{{ $profile->id }}')"> 
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $profile->updated_at ? $profile->updated_at->diffForHumans() : '' }}
                                            </p>
                                        </td>
                                        <td width="10px" class="align-middle">
                                            <div class="d-flex ">
                                                <form action="{{ route('projectAdmin.show', $profile) }}"
                                                    method="get">
                                                    <button type="submit" class="btn bg-gradient-info m-1">Ver
                                                        Perfil</button>
                                                </form>
                                                <form id="borrarProject{{ $profile->id }}"
                                                    action="{{ route('projectAdmin.destroy', $profile) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button type="button" class="btn bg-gradient-danger m-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalProject{{ $profile->id }}">
                                                    Eliminar
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="modalProject{{ $profile->id }}"
                                                    tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-gradient-danger ">
                                                                <h1 class="modal-title fs-5 text-white">
                                                                    Confirmar Borrado del Proyecto</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <p>¿Estás seguro de que deseas eliminar
                                                                    {{ $profile->nombre }}?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal" data-bs-toggle="modal"
                                                                    data-bs-target="#borrarProject{{ $profile->id }}"
                                                                    onclick="event.preventDefault(); document.getElementById('borrarProject{{ $profile->id }}').submit();">
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
                            {{ $profiles->links() }}
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
