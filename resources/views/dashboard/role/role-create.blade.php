@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Crear un nuevo Rol'])

    <div class="container-fluid py-4">
        <div class="card border shadow">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="container py-5 col-6">
                    <form id="nuevoRole" action="{{ route('role.store') }}" method="post">
                        @csrf
                        <div>
                            <h3>Nuevo Role</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre del Role:</label>
                            <input class="form-control" type="text" id="name" name="name"
                                placeholder="Escribe el nombre del nuevo Role" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div>
                            <h6>Permisos a Asignar</h6>
                        </div>
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                    value="{{ $permission->id }}" id="{{ $permission->id }}">
                                <label class="form-check-label" for="{{ $permission->id }}">
                                    {{ $permission->description }}
                                </label>
                            </div>
                        @endforeach
                    </form>
                    <div class="d-flex mt-3">
                        <div>
                            <button type="submit" class="btn bg-gradient-info"
                                onclick="event.preventDefault(); document.getElementById('nuevoRole').submit();">Crear</button>
                        </div>
                        <div>
                            <form action="{{ route('role.index') }}" method="get">
                                <button type="submit" class="btn bg-gradient-danger ms-3">Volver</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
