@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Perfiles'])

    @livewire('project-profile-index', ['project' => $project])

@endsection

