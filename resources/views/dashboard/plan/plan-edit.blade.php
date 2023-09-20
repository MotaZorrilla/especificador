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
                            <textarea class="form-control" type="text" id="description" name="description" placeholder="{{ $plan->description }}"
                                value="{{ $plan->description }}"></textarea>
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
                    <form action="{{ route('plan.destroy', $plan) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn bg-gradient-danger ms-3 ">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
