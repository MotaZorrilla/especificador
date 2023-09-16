<aside class="sidenav bg-white navbar navbar-vertical  navbar-expand-xs border-2 border-radius-xl my-3 fixed-start ms-4 border border-primary " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logoEntumescenteB.png') }}" class="navbar-brand-img " alt="main_logo" style="width: 150%; max-height: 150px;">
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
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mi Perfil</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{  str_contains(request()->url(), 'projectAdmin') == true ? 'active' : '' }}" href="{{ route('projectAdmin.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-file-text-o text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Proyectos Administrador</span>
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{  str_contains(request()->url(), 'project') == true ? 'active' : '' }}" href="{{ route('project.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Mis Proyectos</span>
            </a> --}}
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'users') == true ? 'active' : '' }}" href="{{ route('users.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Usuarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'filedata') == true  ? 'active' : '' }}" href="{{ route('filedata.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-collection text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Data</span>
                </a>
                {{-- <a class="nav-link {{ Route::currentRouteName() == 'virtual-reality' ? 'active' : '' }}" href="{{ route('virtual-reality') }}"> --}}
            </li>
        </ul>

    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        @include('layouts.footers.footer')
    </div>
</aside>