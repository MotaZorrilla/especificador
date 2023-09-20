@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Mis Proyectos'])
    @livewire('project-index')
@endsection
