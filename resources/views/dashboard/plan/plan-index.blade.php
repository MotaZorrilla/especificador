@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Listado de Planes'])
    @livewire('plan-index')
@endsection
