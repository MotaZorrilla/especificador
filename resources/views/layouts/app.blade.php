<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img\icons\logoEntumescenteA.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img\icons\logoEntumescenteA.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img\icons\logoEntumescenteA.png') }}">
    <title>
        Especificador de Pintura Intumescente
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    
    <!-- Font Awesome Icons -->
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .page-content {
            min-height: calc(100vh - 10px);
            /* ajusta el valor 160px de acuerdo a la altura del header y del footer */
        }
    </style>
    @auth
        @yield('css')
    @endauth
    @livewireStyles
</head>

<body class="{{ $mode === 'dark' ? 'dark-version' : '' }}">
    @guest
        @yield('content')
    @endguest
    @auth
        <div class="position-absolute w-100 min-height-300 top-0 mask bg-primary opacity-3"
            style="background-position-y: 50%; background-image: url('{{ asset('assets/img/signup-cover.jpg') }}'); background-position: top;">
        </div>
        @include('layouts.navbars.auth.sidenav')
        <main class="main-content border-radius-lg pb-6">
            @yield('content')
        </main>
    @endauth
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
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
