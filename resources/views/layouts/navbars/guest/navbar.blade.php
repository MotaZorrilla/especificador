<div class="container position-sticky z-index-sticky top-1 " style="background-color: white;">
    <div class="row">
        <div class="col-12">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4 border border-primary">
                <div class="container-fluid">
                    <a class="navbar-brand ms-lg-0 ms-3" href="{{ route('home') }}">
                        <img src="{{ asset('assets/img/logoEntumescenteB.png') }}" alt="Logo" style="max-width: 250px;">
                    </a>                                                              
                    <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon mt-2">
                            <span class="navbar-toggler-bar bar1"></span>
                            <span class="navbar-toggler-bar bar2"></span>
                            <span class="navbar-toggler-bar bar3"></span>
                        </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            @if(Route::currentRouteName() != 'register')
                                <li class="nav-item">
                                    <a href="{{ route('register') }}"   class="btn btn-sm mb-0 me-1 btn-primary">Registrarse</a>
                                </li>
                            @endif
                            @if(Route::currentRouteName() != 'login')
                                <li class="nav-item">
                                    <a href="{{ route('login') }}"      class="btn btn-sm mb-0 me-1 btn-primary">Iniciar Sesión</a>
                                </li>
                            @endif
                        </ul>
                        
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>
    </div>
</div>

