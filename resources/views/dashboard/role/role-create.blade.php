@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Crear un nuevo Rol'])
    @livewire('role-create')
@endsection
@extends('layouts.app')

@section('content')

    @include('layouts.navbars.auth.topnav', ['title' => 'Crear un Nuevo Rol'])
    
@endsection