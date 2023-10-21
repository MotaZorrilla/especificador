@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', [
        'title' => 'Bienvenido al Panel del Especificador de Pintura Intumescente',
    ])
    <div class="container-fluid py-4">
        <div class="row">
            @can('profile')
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('userProfile') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('userProfile') }}">
                                                <p class="text-sm mb-0  font-weight-bold">Mi Perfil</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('userProfile') }}">
                                                <i class="fas fa-user text-lg opacity-10" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            @can('user')
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('user.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('user.index') }}">
                                                <p class="text-sm mb-0  font-weight-bold">Usuarios</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('user.index') }}">
                                                <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
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
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('projectAdmin.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('projectAdmin.index') }}">
                                                <p class="text-sm mb-0  font-weight-bold">Administrador de Proyectos</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('projectAdmin.index') }}">
                                                <i class="ni ni-credit-card text-lg opacity-10" aria-hidden="true"></i>
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
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('project.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('project.index') }}">
                                                <p class="text-sm mb-0  font-weight-bold">Mis Proyectos</p>
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
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('filedata.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('filedata.index') }}">
                                                <p class="text-sm mb-0  font-weight-bold">Data</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('filedata.index') }}">
                                                <i class="fab fa-fw fa-buffer text-lg opacity-10" aria-hidden="true"></i>
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
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('role.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('role.index') }}">
                                                <p class="text-sm mb-0  font-weight-bold">Roles</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('role.index') }}">
                                                <i class="fas fa-fw fa-clipboard text-lg opacity-10" aria-hidden="true"></i>
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
                <div class="col-xl-3 col-sm-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body py-5">
                            <div class="row">
                                <a href="{{ route('plan.index') }}">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <a href="{{ route('plan.index') }}">
                                                <p class="text-sm mb-0  font-weight-bold">Planes</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div
                                            class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                            <a href="{{ route('plan.index') }}">
                                                <i class="fas fa-fw fa-file text-lg opacity-10" aria-hidden="true"></i>
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
