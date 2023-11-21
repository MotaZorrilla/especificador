@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos | Perfiles'])

    @livewire('project-profile-index', ['projectId' => $project])

@endsection

