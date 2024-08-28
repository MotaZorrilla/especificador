@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Bienvenido al Panel del Especificador de Pintura Intumescente',
    ])
    <style>
        .card-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            max-width: 400px;
            min-width: 300px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div class="container-fluid d-flex py-4 mx-auto">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center card-container mx-auto">
            <div class="mb-4 d-flex mx-auto">
                <div class="card shadow flex-fill bg-gradient-info">
                    <div class="card-body py-5">
                        <div class="row">
                            <a href="{{ route('userProfile') }}">
                                <div class="col-8">
                                    <a href="{{ route('userProfile') }}">
                                        <h3 class="text-white mb-0  font-weight-bold">Mi Perfil</h3>
                                        <p class="text-white mb-0  font-weight-bold">Hola {{ $totals['user'] }}</p>
                                    </a>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <a href="{{ route('userProfile') }}">
                                            <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @can('user')
                <div class="mb-4 d-flex">
                    <div class="card shadow flex-fill bg-gradient-info"">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('user.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('user.index') }}">
                                                <H3 class="text-white mb-0  font-weight-bold">Usuarios</h3>
                                                <p class="text-white mb-0  font-weight-bold">Total Usuarios:
                                                    {{ $totals['users'] }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('user.index') }}">
                                                <i class="ni ni-badge text-lg opacity-10" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @can('projectAdmin')
                <div class="mb-4 d-flex">
                    <div class="card shadow flex-fill bg-gradient-info"">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('projectAdmin.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('projectAdmin.index') }}">
                                                <h3 class="text-white mb-0  font-weight-bold">Administrador de Proyectos</h3>
                                                <p class="text-white mb-0 ">Proyectos Totales: {{ $totals['projects'] }}</p>
                                                <p class="text-white mb-0">Perfiles Totales: {{ $totals['profiles'] }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('projectAdmin.index') }}">
                                                <i class="ni ni-laptop text-lg opacity-10" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @can('project')
                <div class="mb-4 d-flex">
                    <div class="card shadow flex-fill bg-gradient-info"">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('project.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('project.index') }}">
                                                <h3 class="text-white mb-0  font-weight-bold">Mis Proyectos</h3>
                                                <p class="text-white mb-0">Proyectos Totales: {{ $totals['user_projects'] }}
                                                </p>
                                                <p class="text-white mb-0">Perfiles Totales: {{ $totals['user_profiles'] }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('project.index') }}">
                                                <i class="ni ni-collection text-lg opacity-10" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @can('filedata')
                <div class="mb-4 d-flex">
                    <div class="card shadow flex-fill bg-gradient-info"">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('filedata.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('filedata.index') }}">
                                                <h3 class="text-white mb-0  font-weight-bold">Data</h3>
                                                <p class="text-white mb-0">Registos Totales de Pinturas: {{ $totals['data'] }}
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('filedata.index') }}">
                                                <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @can('role')
                <div class="mb-4 d-flex">
                    <div class="card shadow flex-fill bg-gradient-info"">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('role.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('role.index') }}">
                                                <h3 class="text-white mb-0  font-weight-bold">Roles</h3>
                                                <p class="text-white mb-0">Roles Totales: {{ $totals['roles'] }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('role.index') }}">
                                                <i class="ni ni-bullet-list-67 text-lg opacity-10" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @can('plan')
                <div class="mb-4 d-flex">
                    <div class="card shadow flex-fill bg-gradient-info"">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('plan.index') }}">
                                    <div class="col-8">
                                        <div class="numbers ">
                                            <a href="{{ route('plan.index') }}">
                                                <h3 class="text-white mb-0  font-weight-bold ">Planes</h3>
                                                <p class="text-white mb-0">Planes Totales: {{ $totals['plans'] }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('plan.index') }}">
                                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
