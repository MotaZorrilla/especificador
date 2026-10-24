<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Verificación Oficial NCh3040 / NCh935 | Especificador Intumescente</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet" />
    <link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Open Sans', sans-serif;
        }
        .verify-card {
            max-width: 780px;
            margin: 2rem auto;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08);
        }
        .tabular-nums {
            font-variant-numeric: tabular-nums;
        }
    </style>
</head>
<body>
    <div class="container px-3">
        <div class="card verify-card border-0">
            <div class="card-header bg-gradient-primary text-white p-4">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <span class="badge bg-white text-primary mb-2">VERIFICACIÓN PÚBLICA DE OBRA (ITO / DOM)</span>
                        <h4 class="text-white mb-0">{{ $project->project }}</h4>
                        <p class="text-sm text-white opacity-8 mb-0">{{ $project->description }}</p>
                    </div>
                    <div class="text-end">
                        @if($isValid)
                            <span class="badge bg-gradient-success fs-6 px-3 py-2">
                                <i class="bi bi-patch-check-fill me-1"></i> DOCUMENTO ÍNTEGRO Y VIGENTE
                            </span>
                        @else
                            <span class="badge bg-gradient-danger fs-6 px-3 py-2">
                                <i class="bi bi-exclamation-octagon-fill me-1"></i> ALERTA: HASH NO COINCIDE
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card-body p-4 tabular-nums">
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-gray-100 border-radius-md">
                            <small class="text-uppercase text-secondary font-weight-bold">UUID de Verificación</small>
                            <div class="text-dark fw-bold text-sm mt-1"><code>{{ $project->verification_uuid }}</code></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-gray-100 border-radius-md">
                            <small class="text-uppercase text-secondary font-weight-bold">Firma Criptográfica SHA-256</small>
                            <div class="text-dark fw-bold text-sm mt-1"><code>{{ substr($storedHash, 0, 28) }}...</code></div>
                        </div>
                    </div>
                </div>

                <h6 class="text-uppercase text-secondary text-xs font-weight-bolder mb-3">
                    Resumen de Perfiles Estructurales Certificados ({{ $project->profiles->count() }})
                </h6>

                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Perfil</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Forma / Exposición</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">Masividad</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-end">Resistencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($project->profiles as $profile)
                                <tr>
                                    <td class="text-sm fw-bold">{{ $profile->nombre }}</td>
                                    <td class="text-sm">{{ $profile->forma }} ({{ $profile->exposicion }})</td>
                                    <td class="text-sm text-end">{{ number_format($profile->masividad, 0) }} m⁻¹</td>
                                    <td class="text-sm text-end">F-{{ number_format($profile->resistencia, 0) }} min</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-secondary text-sm py-3">Sin perfiles asociados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
