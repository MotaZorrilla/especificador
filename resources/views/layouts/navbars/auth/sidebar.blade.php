<div class="offcanvas offcanvas-start border-2 border-radius-xl my-3  ms-4 border border-primary " tabindex="-1"
    id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSb"></i>
        <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Offcanvas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="sidebar-body">
        <aside>
            <hr class="horizontal dark mt-0">
            <div class="  w-auto " >
                <ul class="navbar-nav">
                    <li class="nav-item mt-3 d-flex align-items-center">
                        <div class="ps-4">
                        </div>
                        <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Administración</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                            href="{{ route('profile') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-02 text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Mi Perfil</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(request()->url(), 'projectAdmin') == true ? 'active' : '' }}"
                            href="{{ route('projectAdmin.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-file-text-o text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Proyectos Administrador</span>
                        </a>
                    </li>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(request()->url(), 'users') == true ? 'active' : '' }}"
                            href="{{ route('users.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="fa fa-users text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ str_contains(request()->url(), 'filedata') == true ? 'active' : '' }}"
                            href="{{ route('filedata.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-collection text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Data</span>
                        </a>

                    </li>
                </ul>

            </div>
            <div class="sidenav-footer position-absolute w-100 bottom-0 ">
                @include('layouts.footers.footer')
            </div>
        </aside>
    </div>
</div>
