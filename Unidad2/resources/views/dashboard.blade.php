@extends('layouts.app')

@section('titulo')
   Dashboard
@endsection

@push('styles')
    {{-- Contenido para los estilos propios o asignados respectivamente --}}
    <style>
        /* Contenid para hacer tornasol un texto */
        .text-tornasol {
            background-image: linear-gradient(to bottom right, #AFEEEE, #9932CC);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
@endpush


@section('contenido')
<h1>Dashboard</h1>

<div>
    {{-- <p>Bienvenido(a), {{ Auth::user()->name }}!</p> --}}
    <p>Aquí puedes agregar el contenido y las funcionalidades de tu dashboard.</p>
</div>

<div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</div>
@endsection