@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Usuarios'])

    @livewire('user-index')
    
@endsection