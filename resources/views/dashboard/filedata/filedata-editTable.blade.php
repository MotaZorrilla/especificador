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
                            <!-- Formulario para ordenar -->
                            <form id="orderForm" action="{{ route('filedata.OrderList') }}" method="POST">
                                @csrf
                                <table class="table table-striped">
                                    <thead class="text-right">
                                        <tr>
                                            <th class="col-2 text-center">Posición</th>
                                            <th>Marca de pintura</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pinturas as $index => $brand)
                                            <tr>
                                                <td class="text-center">
                                                    <input class="form-control text-center" type="number"
                                                           step="1" name="orden[{{ $brand }}]" 
                                                           value="{{ $index + 1 }}" min="1" required />
                                                </td>
                                                <td>
                                                    <label class="col-form-label">{{ $brand }}</label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="{{ route('filedata.index') }}" class="btn bg-gradient-info">Cancelar</a>
                                    <button type="submit" class="btn btn-danger" onclick="return validateAndSubmitForm();">
                                        Ordenar BD
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        // Definimos el total de pinturas usando la variable de Blade.
        const totalPinturas = {{ count($pinturas) }};

        function validateAndSubmitForm() {
            const inputs = document.querySelectorAll('input[name^="orden"]');
            let isValid = true;
            let seenValues = new Set();

            inputs.forEach(input => {
                const value = parseInt(input.value);
                // Validar que el valor sea al menos 1, no se repita y no sea mayor que totalPinturas.
                if (value < 1 || seenValues.has(value) || value > totalPinturas) {
                    isValid = false;
                }
                seenValues.add(value);
            });

            if (!isValid) {
                alert(`Verifica que cada posición sea un número entero positivo, único y no mayor a ${totalPinturas}, que es el total de pinturas disponibles`);
                return false;
            }
            return true;
        }
    </script>
@endsection

