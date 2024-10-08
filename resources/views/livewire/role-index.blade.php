<div>
    <div class="container-fluid py-4">
        <div class="card mb-4 border shadow">
            <div class="card-header pb-0 pr-3">
                <h6>Roles</h6>
            </div>
            <div class="card-body pt-0 pb-2 ">
                <div class="table-responsive ">
                    <table class="table align-items-center  ">
                        <tbody>
                            <tr>
                                <td class="d-flex align-items-center">
                                    <div class="align-items-center">
                                        <a href="{{ route('role.create') }}"><img src="{{ asset('/img/icons/crear.png') }}"
                                                class="avatar avatar-sm me-3">Agregar Nuevo Rol</a>
                                    </div>
                                </td>
                                <td class="align-items-center " width="10px">
                                    <a class="btn bg-gradient-info " href="{{ route('role.create') }}">Agragar Nuevo
                                        Rol</a>
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
                        <h6>Roles de Usuarios</h6>
                    </div>
                    <div class="input-group ">
                        <span class="input-group-text text-body">
                            <i class="fas fa-search"></i></span>
                        <input wire:model.live="search" class="form-control" id="search" placeholder="Buscar...">
                    </div>
                </div>
            </div>
            @if ($roles->count())
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
                                        wire:click="order('name')">
                                        Nombre del role
                                        @if ($sort == 'name')
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
                                @foreach ($roles as $role)
                                    <tr>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">{{ $role->id }}</p>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">{{ $role->name }}</p>
                                        </td>
                                        <td class="align-middle text-sm ">
                                            <p class="text-sm font-weight-bold mb-0">
                                                {{ $role->updated_at ? $role->updated_at->diffForHumans() : '' }}
                                            </p>
                                        </td>
                                        <td width="10px" class="align-middle">
                                            <div class="d-flex ">
                                                <form action="{{ route('role.edit', $role) }}" method="get">
                                                    <button type="submit" class="btn bg-gradient-info m-1">Editar
                                                    </button>
                                                </form>
                                                <form id="borrarRole{{ $role->id }}"
                                                    action="{{ route('role.destroy', $role) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <button type="button" class="btn bg-gradient-danger m-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalPlan{{ $role->id }}">
                                                    Eliminar
                                                </button>
    
                                                <!-- Modal -->
                                                <div class="modal fade" id="modalPlan{{ $role->id }}" tabindex="-1" >
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-gradient-danger ">
                                                                <h1 class="modal-title fs-5 text-white" >
                                                                    Confirmar Borrado del Rol</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" ></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <p>¿Estás seguro de que deseas eliminar
                                                                    {{ $role->name }}?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-info"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal" data-bs-toggle="modal"
                                                                    data-bs-target="#borrarRole{{ $role->id }}"
                                                                    onclick="event.preventDefault(); document.getElementById('borrarRole{{ $role->id }}').submit();">
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
                            {{ $roles->links() }}
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
