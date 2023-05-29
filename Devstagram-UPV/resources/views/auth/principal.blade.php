<!-- Crear una directiva para incluir la navegacion -->

@extends('layouts.app')
<!-- Crear el contenido que se le envia al contenedor -->

{{-- Seccion para asignar el titulo --}}
@section('titulo')
    Dashboard
@endsection

{{-- Seccion para asignar el header --}}
@section('header')
    <header class="bg-white shadow" style="background-image: url('./img/fondo.jpeg');">
        <div class="mx-auto max-w-7xl px-2 py-2 sm:px-2 lg:px-8">
            <nav id="nav" class="flex items-center justify-end">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16">
                          <div class="ml-10 flex items-baseline space-x-4 text-2xl text-cyan-500 rounded-md font-medium">
                            <ul class="links">
                                {{-- Seccion para asignar el nav de la pagina web pueden servir como botones de navegacion extra --}}
                                <a href="PERFIL" class="scroll-link px-3 py-2 ">PERFIL</a>
                                <a href="NOTICIAS" class="scroll-link px-3 py-2 ">NOTICIAS</a>
                                <a href="A" class="scroll-link px-3 py-2 ">AA</a>
                                <a href="B" class="scroll-link px-3 py-2 ">BB</a>
                                <a href="C" class="scroll-link px-3 py-2 ">CC</a>
                            </ul>
                          </div>
                    </div>
            </nav>
            {{-- <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard</h1> --}}
        </div>
        {{-- Parte del los titulos para la pagina principal --}}
        <div class="bg-cover bg-center py-12">
            <div class="container mx-auto px-4 text-center text-white">
              <h1 class="text-6xl">César Aldahir <br> Flores Gámez</h1>
              <p class="text-5xl font-bold text-blue-400">¡Bienvenidos a mi Devstagram!</p>
            </div>
        </div>
    </header>
@endsection

{{-- Seccion para asignar el contenido de la mayor parte de la --}}
@section('contenido')
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Your content -->
        Contenido de la pagina
        </div>
    </main>
@endsection

