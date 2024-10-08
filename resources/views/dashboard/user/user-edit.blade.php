@extends('layouts.app')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Usuario'])
    <div class="container-fluid py-4">
        <div class="card border shadow">
            <div class="card-body px-0 pt-0 pb-2">
                @include('components.alert')
                <div class="container py-5 col-6">
                    <form id="formUser" action="{{ route('user.update', $user) }}" method="post">
                        @csrf
                        @method('put')
                        <div>
                            <h3>Editar Opciones del Usuario: <br> "{{ $user->username }}"</h3>
                        </div>
                        <div class="form-group">
                            <div class="mt-2">
                                <label class="form-control-label" for="role">Rol Actual:</label>
                                <input type="text" class="form-control"
                                    value="{{ $user->roles->first()->name ?? 'No Asignado' }}" readonly>

                                <label class="form-control-label" for="new_role">Nuevo Rol:</label>
                                <select class="form-select" id="new_role" name="new_role" required>
                                    <option value="">Asignar un Nuevo Rol al Usuario</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-3">
                                <label class="form-control-label" for="profile_count">Numero de Perfiles Actuales
                                    Disponibles:</label>
                                <input type="text" class="form-control" value="{{ $user->profile_count ?? 'No Asignado' }}"
                                    readonly>
                                <label class="form-control-label" for="new_plan">Asigna un Nuevo Plan de Perfiles:</label>
                                <select class="form-select mb-3" id="new_plan" name="new_plan" required>
                                    <option value="">Asignar un Nuevo Plan al Usuario</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->name }}: {{ $plan->profile_count }} perfiles</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="d-flex ">
                            <div>
                                <button type="submit" class="btn bg-gradient-success">
                                {{-- onclick="event.preventDefault(); document.getElementById('formUser').submit();"> --}}
                                Actualizar</button>
                            </div>
                        </form>
                        <form action="{{ route('user.index') }}" method="get">
                            <button type="submit" class="btn bg-gradient-info ms-3">Volver</button>
                        </form>
                        <form id="borrarUser{{ $user->id }}" action="{{ route('user.destroy', $user) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                        </form>
                        <button type="button" class="btn bg-gradient-danger ms-3" data-bs-toggle="modal"
                            data-bs-target="#modalPlan{{ $user->id }}">
                            Eliminar
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modalPlan{{ $user->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-gradient-danger ">
                                        <h1 class="modal-title fs-5 text-white">
                                            Confirmar Borrado del Usuario</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>¿Estás seguro de que deseas eliminar
                                            {{ $user->username }}?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info"
                                            data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                            data-bs-toggle="modal" data-bs-target="#borrarUser{{ $user->id }}"
                                            onclick="event.preventDefault(); document.getElementById('borrarUser{{ $user->id }}').submit();">
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
