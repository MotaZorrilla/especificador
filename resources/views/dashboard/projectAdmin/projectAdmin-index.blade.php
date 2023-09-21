@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Proyectos | Administradores'])

    @livewire('project-admin-index')

@endsection

