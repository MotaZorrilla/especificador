<div class="px-4 pt-3">
    @if (session()->has('success'))
        <div class="alert text-white alert-dismissible fade show d-flex align-items-center mb-3 p-3" role="alert" style="background: linear-gradient(310deg, #10b981 0%, #059669 100%); border-radius: 8px; border: none;">
            <i class="fas fa-check-circle fs-5 me-2"></i>
            <div>
                <strong>Operación Exitosa:</strong> {{ session()->get('success') }}
            </div>
            <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
        </div>
    @endif

    @if (session()->has('import_warning'))
        <div class="alert text-white alert-dismissible fade show mb-3 p-3" role="alert" style="background: linear-gradient(310deg, #ea580c 0%, #d97706 100%); border-radius: 8px; border: none;">
            <div class="d-flex align-items-center mb-1">
                <i class="fas fa-exclamation-triangle fs-5 me-2"></i>
                <div>
                    <strong>Observaciones de Importación:</strong> {{ session()->get('import_warning') }}
                </div>
            </div>
            @if (session()->has('import_errors') && count(session()->get('import_errors')) > 0)
                <div class="mt-2 pt-2" style="border-top: 1px solid rgba(255,255,255,0.25);">
                    <small class="d-block mb-1 font-weight-bold">Detalle de filas no procesadas (primeras 10):</small>
                    <ul class="mb-0 ps-3 text-xs" style="line-height: 1.4;">
                        @foreach (array_slice(session()->get('import_errors'), 0, 10) as $err)
                            <li><strong>Fila {{ $err['row'] }}:</strong> {{ $err['reason'] }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert text-white alert-dismissible fade show d-flex align-items-center mb-3 p-3" role="alert" style="background: linear-gradient(310deg, #dc2626 0%, #991b1b 100%); border-radius: 8px; border: none;">
            <i class="fas fa-times-circle fs-5 me-2"></i>
            <div>
                <strong>Error:</strong> {{ session()->get('error') }}
            </div>
            <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert text-white alert-dismissible fade show mb-3 p-3" role="alert" style="background: linear-gradient(310deg, #dc2626 0%, #b91c1c 100%); border-radius: 8px; border: none;">
            <div class="d-flex align-items-center mb-1">
                <i class="fas fa-exclamation-circle fs-5 me-2"></i>
                <strong>Errores de Validación:</strong>
            </div>
            <ul class="mb-0 ps-3 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
        </div>
    @endif
</div>
