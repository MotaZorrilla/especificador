@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Editar Rol'])
    @livewire('role-edit')
@endsection
