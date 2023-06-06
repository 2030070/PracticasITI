@extends('layouts.app')

{{-- @vite('resources/css/app.css') --}}
@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center" >
        <div class="md:w-5/12 p-5 ">
            <!-- insertar imagen utilizando "assert" (acceder a carpeta public)-->
            <img src="{{ asset('img/13.jpg') }}" alt="Imagen login de usuarios" style="border-radius: 15px; border: 3px solid #617a7a;">
            <label for="password" class="mb-2 block text-center text-cyan-800 font-bold">
                ¡Bienvenido a la practica uno, inica sesión o registrate!
            </label>
        </div>
        <div class="md:w-5/12 bg-white p-6 rounded-xl shadow-xl">
            {{-- no validate para validar cosas del lado del serivdor --}}
            <div class="container mx-auto text-center">
                <h1 class="text-4xl font-bold text-gray-700">Login</h1>
            </div>
            {{-- Contenido del formulario --}}
            <div class="bg-white p-10 rounded-2xl">
                {{-- Nombre de la pagina --}}
                

                {{-- Formulario de login --}}
                <form action="{{ route('login') }}" method="POST" novalidate>

                    {{-- Directiva de seguridad --}}
                    @csrf

                    {{-- Verificar la session --}}
                    @if (session('mensaje'))
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('mensaje') }}</p>
                    @endif


                    {{-- Email --}}
                    <div class="mb-5">
                        <label for="email" class="mb-2 block uppercase text-cyan-700 font-bold">Email</label>
                        <input type="email" name="email" id="email" placeholder="Email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{old('email')}}" />
                        @error('email')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-5">
                        <label for="password" class="mb-2 block uppercase text-cyan-700 font-bold">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror" value="{{old('password')}}"/>
                        @error('password')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                    </div>

                    {{-- Submit --}}
                    <div class="mb-5 flex justify-center">
                        <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded-lg">
                            Login</button>
                    </div>

                </form>
            </div>
        </div>
        
    </div>
@endsection
