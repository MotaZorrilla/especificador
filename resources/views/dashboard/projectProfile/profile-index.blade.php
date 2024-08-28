@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos | Proyecto'])
    
    @livewire('project-profile-index', ['projectId' => $project])

@endsection

