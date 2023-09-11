<div>
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Administrar Usuarios</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    {{-- <a href="{{route('filedataExcel')}}"><img src="/img/icons/export.png" class="avatar avatar-sm me-3"></a> --}}
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Exportar lista de Usuarios a Excel</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-right ">
                                            {{-- <a class="badge badge-sm bg-gradient-info" href="{{route('fileExcel')}}">Exportar</a> --}}
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
                        @if ($users->count())
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
                                                wire:click="order('username')">
                                                Usuario
                                                @if ($sort == 'username')
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
                                                wire:click="order('firstname')">
                                                Nombre
                                                @if ($sort == 'firstname')
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
                                                wire:click="order('lastname')">
                                                Apellido
                                                @if ($sort == 'lastname')
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
                                                wire:click="order('email')">
                                                Email
                                                @if ($sort == 'email')
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
                                                wire:click="order('role')">
                                                Tipo
                                                @if ($sort == 'role')
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
                                                Registrado
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xs font-weight-bolder text-left opacity-7 ps-2">
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->id }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->username }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->firstname }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->lastname }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->email }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">{{ $user->tipo }}</p>
                                                </td>
                                                <td class="align-middle text-sm">
                                                    <p class="text-sm font-weight-bold mb-0">
                                                        {{ $user->updated_at ? $user->updated_at->diffForHumans() : '' }}
                                                    </p>
                                                </td>
                                                <td width="10px" class="align-middle ">
                                                    <div class="d-flex ">
                                                        <form action="{{ route('users.edit', $user) }}" method="get">
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
                                    {{ $users->links() }}
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
