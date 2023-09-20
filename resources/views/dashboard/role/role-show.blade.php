@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Mostrar Detalles del Rol'])
    @livewire('role-show')
@endsection
