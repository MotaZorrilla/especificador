@extends('layouts.app')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Asignar Rol de Usuario'])
    <div>
        <div class="container-fluid py-4">
            
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body col-6 mx-auto">
                            <h2 class="h5">Asignar Rol al Usuario: "{{ $user->username }}"</h2>
                            <div class="form-control">
                                <div class="form-group">
                                    <label class="form-control-label">Roles de Usuarios</label>
                                    @foreach ($roles as $role)
                                    <div class="form-check" >
                                        <input class="form-check-input" type="radio" id="{{ $role->name }}" name="{{ $role->name }}"  >
                                        <label class="form-check-label" for="{{ $role->name }}">{{ $role->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection