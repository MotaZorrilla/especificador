@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Rol'])

    <div class="container-fluid py-4">
        <div class="card border shadow">
            <div class="card-body px-0 pt-0 pb-2">
                @include('components.alert')
                <div class="container py-5 col-6">
                    <form id="formRole" action="{{ route('role.update', $role) }}" method="post">
                        @csrf
                        @method('put')
                        <div>
                            <h3>Actualizar Rol</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre del Rol:</label>
                            <input class="form-control" type="text" id="name" name="name"
                                value="{{ $role->name }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <h6>Permisos a Asignar</h6>
                        </div>
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                    value="{{ $permission->id }}" id="{{ $permission->id }}"
                                    {{ $role->hasPermissionTo($permission->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $permission->id }}">
                                    {{ $permission->description }}
                                </label>
                            </div>
                        @endforeach
                    </form>
                    <div class="d-flex ">
                        <div>
                            <button type="submit" class="btn bg-gradient-success "
                                onclick="event.preventDefault(); document.getElementById('formRole').submit();">
                                Actualizar</button>
                        </div>
                        <form action="{{ route('role.index') }}" method="get">
                            <button type="submit" class="btn bg-gradient-info ms-3">Volver</button>
                        </form>
                        <form id="borrarRole{{ $role->id }}" action="{{ route('role.destroy', $role) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                        </form>
                        <button type="button" class="btn bg-gradient-danger ms-3" data-bs-toggle="modal"
                            data-bs-target="#modalrole{{ $role->id }}">
                            Eliminar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalrole{{ $role->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-gradient-danger ">
                                        <h1 class="modal-title fs-5 text-white">
                                            Confirmar Borrado de role</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>¿Estás seguro de que deseas eliminar
                                            {{ $role->name }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                            data-bs-toggle="modal" data-bs-target="#borrarRole{{ $role->id }}"
                                            onclick="event.preventDefault(); document.getElementById('borrarRole{{ $role->id }}').submit();">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
