@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Administrador de Base de Datos'])
    @livewire('filedata-index')
@endsection
