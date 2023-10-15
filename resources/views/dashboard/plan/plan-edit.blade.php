@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Plan'])
    
    <div class="container-fluid py-4">
        <div class="card border shadow">
            <div class="card-body px-0 pt-0 pb-2">
                @include('components.alert')
                <div class="container py-5 col-6">
                    <form action="{{ route('plan.update', $plan) }}" method="post">
                        @csrf
                        @method('put')
                        <div>
                            <h3>Actualizar Plan</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="name">Nombre del Plan:</label>
                            <input class="form-control" type="text" id="name" name="name"
                                value="{{ $plan->name }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="description">Descripción:</label>
                            <textarea class="form-control" type="text" id="description" name="description" >{{ $plan->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="profile_count">Numero de Perfiles:</label>
                            <input class="form-control" type="number" id="profile_count" name="profile_count"
                                value="{{ $plan->profile_count }}" step="1" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="price">Precio:</label>
                            <input class="form-control" type="number" id="price" name="price"
                                value="{{ $plan->price }}" step="0.01" required>
                        </div>
                        {{-- boton --}}
                        <div class="d-flex ">
                            <div>
                                <button type="submit" class="btn bg-gradient-success ">Actualizar</button>
                            </div>
                    </form>
                    <form action="{{ route('plan.index') }}" method="get">
                        <button type="submit" class="btn bg-gradient-info ms-3">Volver</button>
                    </form>
                    <form id="borrarPlan{{ $plan->id }}"
                        action="{{ route('plan.destroy', $plan) }}" method="POST">
                        @csrf
                        @method('delete')
                    </form>
                    <button type="button" class="btn bg-gradient-danger ms-3"
                        data-bs-toggle="modal"
                        data-bs-target="#modalPlan{{ $plan->id }}">
                        Eliminar
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalPlan{{ $plan->id }}" tabindex="-1" >
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-gradient-danger ">
                                    <h1 class="modal-title fs-5 text-white" >
                                        Confirmar Borrado de Plan</h1>
                                    <button type="button" class="btn-close"
                                        data-bs-dismiss="modal" ></button>
                                </div>
                                <div class="modal-body text-center">
                                    <p>¿Estás seguro de que deseas eliminar
                                        {{ $plan->name }}?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal" data-bs-toggle="modal"
                                        data-bs-target="#borrarPlan{{ $plan->id }}"
                                        onclick="event.preventDefault(); document.getElementById('borrarPlan{{ $plan->id }}').submit();">
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
@endsection
