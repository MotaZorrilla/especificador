<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header">
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="../img\icons\android-chrome-512x512.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Especificador de <br> Pintura Intumescente</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Administración</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}" href="{{ route('profile') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mi Perfil</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{  str_contains(request()->url(), 'project') == true ? 'active' : '' }}" href="{{ route('project.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-credit-card text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mis Proyectos</span>
                </a>
            </li>  
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'users') == true ? 'active' : '' }}" href="{{ route('users') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-bullet-list-67 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuarios</span>
                </a>
            </li>    
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'database' ? 'active' : '' }}" href="{{ route('database') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data</span>
                </a>
            </li>
        </ul>
    </div>
    
</aside>
