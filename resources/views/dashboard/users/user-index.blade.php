@extends('layouts.app')
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Usuarios'])
    <div>
        @livewire('users-index')
    </div>
@endsection