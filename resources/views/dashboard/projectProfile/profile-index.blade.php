@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Visor de Proyectos'])

    @livewire('project-profile-index', ['projectId' => $project])

@endsection

