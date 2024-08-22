<aside>
    <div class="offcanvas offcanvas-start border-2 fade border-radius-xl my-3 mx-3 border border-primary"
        style="max-width: 350px; transition-duration: 0.9s;" tabindex="-1" id="offcanvasSidebar"
        aria-labelledby="offcanvasSidebarLabel">
        <div class="offcanvas-header px-3 shadow-sm">
            <a class="navbar-brand m-0 " href="{{ route('home') }}" id="offcanvasSidebarLabel">
                <img src="{{ asset('assets/img/logoEntumescenteB.png') }}" class="navbar-brand-img " alt="main_logo"
                    style="width: 100%; max-height: 150px;">
            </a>
            <button type="button" class="btn-close bg-primary mx-3 mt-0 align-self-start" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column h-100 justify-content-between mb-1">
            <div class="container-fluid py-1 px-3 d-flex flex-column  h-100">
                <div class="navbar h-100 ">
                    <ul class="navbar-nav align-self-start w-100">
                        <li class="nav-item mt-1 mb-2 d-flex align-items-center w-auto">
                            <div class="ps-4">
                                <h6 class="ms-2 text-uppercase text-center font-weight-bolder opacity-6 mb-0">
                                    Administración</h6>
                            </div>
                        </li>
                        <hr class="horizontal dark mt-0">
                        @can('profile')
                            <li class="nav-item mt-3 d-flex align-items-center">
                                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'text-primary' : '' }} "
                                    href="{{ route('userProfile') }}">
                                    <i class="ni ni-single-02 text-warning me-2"></i> Mi Perfil
                                </a>
                            </li>
                        @endcan
                        @can('user')
                            <li class="nav-item mt-3 d-flex align-items-center">
                                <a class="nav-link {{ str_contains(request()->url(), 'user') == true ? 'text-primary' : '' }} "
                                    href="{{ route('user.index') }}">
                                    <i class="ni ni-badge text-warning me-2"></i> Usuarios
                                </a>
                            </li>
                        @endcan
                        @can('projectAdmin')
                            <li class="nav-item mt-3 d-flex align-items-center">
                                <a class="nav-link {{ str_contains(request()->url(), 'projectAdmin') == true ? 'text-primary' : '' }} "
                                    href="{{ route('projectAdmin.index') }}">
                                    <i class="ni ni-laptop text-warning me-2"></i> Administrador de Proyectos
                                </a>
                            </li>
                        @endcan
                        @can('project')
                            <li class="nav-item mt-3 d-flex align-items-center">
                                <a class="nav-link {{ str_contains(request()->url(), 'project') == true && str_contains(request()->url(), 'projectAdmin') == false
                                    ? 'text-primary'
                                    : '' }} "
                                    href="{{ route('project.index') }}">
                                    <i class="ni ni-collection text-warning me-2"></i> Mis Proyectos
                                </a>
                            </li>
                        @endcan
                        @can('filedata')
                            <li class="nav-item mt-3 d-flex align-items-center">
                                <a class="nav-link {{ str_contains(request()->url(), 'filedata') == true ? 'text-primary' : '' }} "
                                    href="{{ route('filedata.index') }}">
                                    <i class="ni ni-single-copy-04 text-warning me-2"></i> Data
                                </a>
                            </li>
                        @endcan
                        @can('role')
                            <li class="nav-item mt-3 d-flex align-items-center">
                                <a class="nav-link {{ str_contains(request()->url(), 'Roles') == true ? 'text-primary' : '' }} "
                                    href="{{ route('role.index') }}">
                                    <i class="ni ni-bullet-list-67 text-warning me-2"></i> Roles
                                </a>
                            </li>
                        @endcan
                        @can('plan')
                            <li class="nav-item mt-3 d-flex align-items-center">
                                <a class="nav-link {{ str_contains(request()->url(), 'Planes') == true ? 'text-primary' : '' }} "
                                    href="{{ route('plan.index') }}">
                                    <i class="ni ni-money-coins text-warning me-2"></i> Planes
                                </a>
                            </li>
                        @endcan
                    </ul>
                    <div class="d-flex  flex-column align-self-end h-auto ">
                        <hr class="horizontal dark mt-3 mb-3">
                        @include('layouts.footers.footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
