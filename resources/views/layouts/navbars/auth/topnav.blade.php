<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm border-radius-lg mt-3 mx-3  {{ $mode === 'dark' ? 'dark-version' : 'bg-gradient-danger' }}">
    <div class="container-fluid">
        <a class="navbar-brand m-0 p-0 bg-white border-radius-lg" href="{{ route('home') }}" id="offcanvasSidebarLabel">
            <img src="{{ asset('assets/img/logoEntumescenteB.png') }}" class="navbar-brand-img" alt="main_logo"
                style="max-width: 200px; max-height: 100px;">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <h5 class="font-weight-bolder text-white ms-6 mb-0">{{ $title }}</h5>
                </li>
            </ul>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-between border border-radius-md my-auto ml-auto px-2 me-2 ">
                <p class="nav-link text-white font-weight-bold px-0 text-white me-2 mb-0 d-sm-inline d-none">Claro / Oscuro</p>
                <form action="{{ route('darkmode') }}" method="POST">
                    @csrf
                    <div class="form-check form-switch ps-0 ms-auto my-auto me-2">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" name="mode"
                            onchange="this.form.submit()" {{ $mode === 'dark' ? 'checked' : '' }}>
                    </div>
                </form>
            </div>
            <button class="btn border my-auto ml-auto me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="ni ni-align-left-2 ml-auto text-white"></span>
            </button>
            
            <div class="d-flex align-items-center justify-content-between border border-radius-md my-auto ml-auto px-2 me-2">
                <form role="form" method="post" action="{{ route('logout') }}" id="logout-form">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link text-white font-weight-bold px-0">
                        <i class="ni ni-user-run me-sm-1"></i>
                        <span class="d-sm-inline d-none">Log out</span>
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
<!-- End Navbar -->
