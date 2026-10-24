<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dispositivo No Autorizado | Especificador de Pintura Intumescente</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet" />
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #0f172a;
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Open Sans', sans-serif;
        }
        .lock-card {
            max-width: 620px;
            width: 100%;
            background: #1e293b;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
        }
        .tabular-nums {
            font-variant-numeric: tabular-nums;
        }
    </style>
</head>
<body>
    <div class="container px-3">
        <div class="lock-card mx-auto p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="icon icon-shape icon-lg bg-gradient-danger shadow text-center border-radius-lg mb-3 mx-auto d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                    <i class="bi bi-shield-exclamation text-white fs-3"></i>
                </div>
                <h4 class="text-white font-weight-bolder mb-1">Equipo No Autorizado (Licencia 1:1)</h4>
                <p class="text-sm text-secondary mb-0">
                    Protección de Propiedad Intelectual y Suscripción Individual Anual
                </p>
            </div>

            <div class="alert alert-danger text-white text-sm" role="alert">
                <strong>Estado: {{ $guardResult['status'] ?? 'DEVICE_LOCKED_MISMATCH' }}</strong><br>
                {{ $guardResult['message'] ?? 'Tu licencia anual ya está vinculada a otro computador.' }}
            </div>

            <div class="bg-dark border-radius-md p-3 mb-4 text-sm tabular-nums">
                <div class="d-flex justify-content-between py-1 border-bottom border-secondary">
                    <span class="text-secondary">Usuario Licenciado:</span>
                    <span class="text-white fw-bold">{{ $user->email ?? 'N/A' }}</span>
                </div>
                <div class="d-flex justify-content-between py-1 border-bottom border-secondary">
                    <span class="text-secondary">Huella Hardware Registrada:</span>
                    <code class="text-info">{{ substr($guardResult['registered_fingerprint'] ?? $user->registered_device_fingerprint ?? 'N/A', 0, 18) }}...</code>
                </div>
                <div class="d-flex justify-content-between py-1 border-bottom border-secondary">
                    <span class="text-secondary">Huella Hardware Detectada:</span>
                    <code class="text-warning">{{ substr($guardResult['current_fingerprint'] ?? 'N/A', 0, 18) }}...</code>
                </div>
                <div class="d-flex justify-content-between py-1">
                    <span class="text-secondary">Transferencias Disponibles este Año:</span>
                    <span class="badge {{ ($guardResult['remaining_transfers'] ?? 0) > 0 ? 'bg-gradient-success' : 'bg-gradient-danger' }}">
                        {{ $guardResult['remaining_transfers'] ?? 0 }} restantes (Máx. 2/año)
                    </span>
                </div>
            </div>

            @if(($guardResult['can_self_reassign'] ?? false) && ($guardResult['remaining_transfers'] ?? 0) > 0)
                <form action="{{ route('security.reassign') }}" method="POST" class="mb-3">
                    @csrf
                    <input type="hidden" name="new_fingerprint" value="{{ $guardResult['current_fingerprint'] ?? '' }}">
                    <input type="hidden" name="device_name" value="Estación Reasignada ({{ now()->format('d/m/Y H:i') }})">
                    <button type="submit" class="btn bg-gradient-primary w-100 mb-2">
                        <i class="bi bi-arrow-left-right me-2"></i>
                        Autorizar este Equipo Ahora (Usa 1 de tus {{ $guardResult['remaining_transfers'] }} transferencias anuales)
                    </button>
                </form>
            @else
                <div class="alert alert-warning text-dark text-sm mb-3">
                    Has agotado tus <strong>2 cambios anuales de equipo por autoservicio</strong>. Contacta a soporte administrativo para liberar tu licencia.
                </div>
            @endif

            @if(session()->has('simulated_device_fingerprint'))
                <form action="{{ route('security.clear') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100 btn-sm">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Volver al Dispositivo Original (Cerrar Simulación)
                    </button>
                </form>
            @endif
        </div>
    </div>
</body>
</html>
