@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ordenar Base de Datos Por Marca de Pintura'])
    <div class="container-fluid py-4">
        
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">  
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="container py-5 col-4">   
                            <h3>Ordenar por marca de pinturas</h3>
                            <div>
                                <form id="orderForm" action="{{ route('filedata.OrderList') }}" method="POST" >
                                    @csrf
                                    <table class="table table-striped  ">
                                        <thead class="text-right">
                                            <tr>
                                                <th class="col-2 text-center">
                                                    <div class="row g-1 col-2    ">
                                                        <div class="col-2">
                                                            Posición
                                                        </div>
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="row g-1 ">
                                                        <div class="col-auto">
                                                            Marca de pintura
                                                        </div>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($filedata as $index => $brand)
                                            <tr>
                                                <th class="col-3 text-center">
                                                    <div class="row g-1 text-center ">
                                                        <div class="col-10">
                                                            <input class="form-control text-center" type="number" step="1" name="orden[]" value="{{ $index + 1 }}" min="1"/>
                                                        </div>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="row g-1 align-items-center ">
                                                        <div class="col-auto">
                                                            <label class="col-form-label">{{ $brand }}</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>                               
                                </form>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-auto align-items-center">
                                    <form action="{{ route('filedata.index') }}" method="get">
                                        <button type="submit" class="btn bg-gradient-info m-1">Cancelar</button>
                                    </form>
                                </div>
                                <div class="col-auto align-items-center">
                                    <button type="button" class="btn btn-danger" data-bs-target="#orderForm" id="confirmOrder" 
                                        onclick="validateAndSubmitForm()">
                                        Ordenar BD
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <script>
        function validateAndSubmitForm() {
            // Obtener todos los campos de entrada con nombre 'orden[]'
            const ordenInputs = document.querySelectorAll('input[name="orden[]"]');
            let isValid = true;
            let seenValues = new Set(); // Usamos un Set para almacenar valores únicos
    
            // Verificar si al menos uno de los campos es menor que 1 o se repite
            for (const input of ordenInputs) {
                const value = parseInt(input.value);
    
                if (value < 1 || seenValues.has(value)) {
                    isValid = false;
                    break;
                }
    
                seenValues.add(value); // Agregar el valor al conjunto
            }
    
            if (isValid) {
                // Si todos los campos son válidos, enviar el formulario
                document.getElementById('orderForm').submit();
            } else {
                // Mostrar un mensaje de error o tomar otra acción apropiada
                alert('Por favor, asegúrese de que todos los campos sean al menos 1 y no se repitan.');
            }
        }
    </script>   
@endsection


