<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/icons/logoEntumescenteA.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/icons/logoEntumescenteA.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/icons/logoEntumescenteA.png') }}">
    <title>
        @yield('title', 'Especificador de Pintura Intumescente')
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet" />
    <!-- Nucleo Icons (Local Auto-Contenidos) -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files (Identidad Visual Argon Dashboard Unificada) -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .page-content {
            min-height: calc(100vh - 10px);
        }
        /* Precisión ingenieril: alineación tabular para masividad (m⁻¹), espesores (μm) y F-rating */
        .tabular-nums,
        table td,
        .masividad-value,
        input[type="number"] {
            font-variant-numeric: tabular-nums;
        }
        .security-hud-bar {
            background: rgba(15, 23, 42, 0.88);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.14);
            color: #f8fafc;
            font-size: 0.78rem;
            z-index: 1040;
        }
    </style>
    @auth
        @yield('css')
    @endauth
    @livewireStyles
</head>

<body class="{{ ($mode ?? 'light') === 'dark' ? 'dark-version' : '' }}">
    @guest
        @yield('content')
    @endguest
    @auth
        <div class="position-absolute w-100 min-height-300 top-0 mask bg-primary opacity-3"
            style="background-position-y: 50%; background-image: url('{{ asset('assets/img/signup-cover.jpg') }}'); background-position: top;">
        </div>
        @include('layouts.navbars.auth.sidenav')
        <main class="main-content border-radius-lg pb-6">
            {{-- Barra Superior Unificada de Estado de Licencia 1:1 y Simulador de Dispositivo --}}
            <div class="security-hud-bar px-4 py-2 d-flex flex-wrap align-items-center justify-content-between rounded-bottom mx-3 mb-2">
                <div class="d-flex align-items-center gap-3">
                    <span class="badge bg-gradient-success">
                        <i class="bi bi-shield-lock-fill me-1"></i> Licencia 1:1 Activa
                    </span>
                    <span class="tabular-nums">
                        <strong>Huella Hardware:</strong>
                        <code>{{ substr(auth()->user()->registered_device_fingerprint ?? 'PENDIENTE', 0, 12) }}...</code>
                    </span>
                    <span class="tabular-nums">
                        <strong>Cambios Anuales ({{ now()->year }}):</strong>
                        {{ auth()->user()->device_transfers_used_this_year ?? 0 }} / {{ auth()->user()->max_device_transfers ?? 2 }}
                    </span>
                    @if(auth()->user()->tenant)
                        <span class="badge bg-gradient-info">
                            <i class="bi bi-building me-1"></i> {{ auth()->user()->tenant->name }}
                        </span>
                    @endif
                </div>
                <div class="d-flex align-items-center gap-2 mt-1 mt-md-0">
                    <form action="{{ route('security.simulate') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="fingerprint" value="SIMULATED-SECOND-PC-{{ now()->timestamp }}">
                        <button type="submit" class="btn btn-xs btn-warning mb-0 py-1 px-2" title="Simular acceso desde otro PC no autorizado">
                            <i class="bi bi-laptop me-1"></i> Simular PC #2 (Bloqueo)
                        </button>
                    </form>
                    @if(session()->has('simulated_device_fingerprint'))
                        <form action="{{ route('security.clear') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-xs btn-outline-light mb-0 py-1 px-2">
                                Restaurar PC Original
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            @yield('content')
        </main>
    @endauth
    <!-- Core JS Files (Locales, sin CDN roto de FontAwesome) -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    @auth
        @yield('js')
    @endauth
    @stack('js')
    @livewireScripts
</body>

</html>
