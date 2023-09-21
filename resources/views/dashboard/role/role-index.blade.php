@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Listado de Roles'])
    
    @livewire('role-index')

@endsection
