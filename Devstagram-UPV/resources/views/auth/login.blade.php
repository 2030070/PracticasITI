@extends('layouts.app')


@section('titulo')
    Inicia Sesión en Devstgram-UPV
@endsection 

@section('contenido')
<div class="md:flex md:justify-center md:gap-10 md:items-center">
    <div class="md:w-5/12 p-5 ">
        <!-- insertar imagen utilizando "assert" (acceder a carpeta public)-->
        <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuarios" style="border-radius: 15px; border: 3px solid #617a7a;">
    </div>
    <div class="md:w-5/12 bg-white p-6 rounded-1g shadow-xl">
        {{-- no validate para validar cosas del lado del serivdor --}}
        <form action="{{route('login')}}" method="POST" novalidate>
            {{-- csrf sirve para evitar ataques de bots y evitar llenar la tabla de datos basura --}}
            {{-- Tambien crea un token seguro --}}
            @csrf
            @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{session('mensaje')}}
                </p>
            @endif


            {{-- Email --}}
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-cyan-700 font-bold">Email</label>
                <input id="email" name="email" type="text" placeholder="Tu email de registro"
                    class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{old('email')}}" />
            </div>
            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-cyan-700 font-bold">Password</label>
                <input id="password" name="password" type="password" placeholder="Password de registro "
                    class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" value="{{old('password')}}"/>
            </div>
            {{-- Checar de mantener la sesion abierta --}}
            <div class="mb-5">
                <input type="checkbox" name="remember">
                    <lable class="text-gray-600 text-sm">Mantener mi sesión abierta</label>
                
            </div>
            <input type="submit" value="Iniciar Sesion"
                class="bg-gray-800 hover:bg-gray-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
        </form>
    </div>
</div>
@endsection