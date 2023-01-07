@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Importar y Exportar Tablas</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Importar Tablas</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('import')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @if (Session::has('message'))
                                                <p>{{ Session::get('messsage')}}</p>
                                                @endif
                                                
                                                <td class="align-middle text-center text-sm">
                                                    <button class="badge badge-sm bg-gradient-success" type="submit">Importar</button>
                                                </td>
                                                <td>
                                                    <input type="file" name="file">
                                                </td>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="/img/team-3.jpg" class="avatar avatar-sm me-3"
                                                        alt="user2">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Exportar Tablas</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <a class="badge badge-sm bg-gradient-secondary" href="{{route('export')}}">Exportar</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Datos de Pinturas</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            id</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Pintura</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Modelo</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Certificado</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            Masividad</th>   
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            15m</th> 
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            30m</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            60m</th>
                                        <th
                                            class="text-uppercase text-secondary text-xs font-weight-bolder text-center opacity-7 ps-2">
                                            90m</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($files as $file)
                                    <tr>
                                        <td>
                                            <span class="text-xs text-center font-weight-bold ps-2">{{ $file->id }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-center font-weight-bold ps-2">{{ $file->pintura }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-center font-weight-bold ps-2">{{ $file->modelo }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-center font-weight-bold ps-2">{{ $file->certificado }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-center font-weight-bold ps-2">{{ $file->masividad }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-center font-weight-bold ps-2">{{ $file->m15 }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-center font-weight-bold ps-2">{{ $file->m30 }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-center font-weight-bold ps-2">{{ $file->m60 }}</span>
                                        </td>
                                        <td>
                                            <span class="text-xs text-center font-weight-bold ps-2">{{ $file->m90 }}</span>
                                        </td>
                                    </tr>
                                    @endforeach                                   
                                </tbody>
                            </table>
                            {{ $files->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
