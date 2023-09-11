@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Bienvenido al Panel del Especificador de Pintura Intumescente'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body py-5">
                        <div class="row">
                            <a href="{{ route('profile') }}">
                            <div class="col-8">
                                <div class="numbers">
                                    <a href="{{ route('profile') }}">
                                    <p class="text-sm mb-0  font-weight-bold">Mi Perfil</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <a href="{{ route('profile') }}">
                                    <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body py-5">
                        <div class="row">
                            <a href="{{ route('projectAdmin.index') }}">
                            <div class="col-8">
                                <div class="numbers">
                                    <a href="{{ route('projectAdmin.index') }}">
                                    <p class="text-sm mb-0  font-weight-bold">Proyectos de Administrador</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
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
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body py-5">
                        <div class="row">
                            <a href="{{ route('users.index') }}">
                            <div class="col-8">
                                <div class="numbers">
                                    <a href="{{ route('users.index') }}">
                                    <p class="text-sm mb-0  font-weight-bold">Usuarios</p>
                                    </a>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <a href="{{ route('users.index') }}">
                                    <i class="ni ni-bullet-list-67 text-lg opacity-10" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
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
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <a href="{{ route('filedata.index') }}">
                                    <i class="ni ni-collection text-lg opacity-10" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fb6340",
                    backgroundColor: gradientStroke1,
                    borderWidth: 3,
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#fbfbfb',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#ccc',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>
@endpush
