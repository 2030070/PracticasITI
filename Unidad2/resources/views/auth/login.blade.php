@extends('layouts.app')


@section('contenido')
<div class="flex justify-center items-center h-screen">
    <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3 xl:w-1/4 rounded-lg bg-white shadow-lg p-8">
        <h1 class="text-center text-3xl font-bold mb-6">Iniciar sesión</h1>

        <form method="POST" action="{{route('login')}}" class="space-y-4">
            @csrf
            @if(session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{session('mensaje')}}
                </p>
            @endif
            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                        <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path>
                    </svg>
                    <label for="email" class="block ml-2">Email</label>
                </div>
                <input id="email" name="email" type="text" placeholder="Tu email de registro"
                    class="w-full p-2 pl-8 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') @enderror" value="{{old('email')}}" />
            </div>
            
            <div>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256 256">
                        <path d="M208,80H176V56a48,48,0,0,0-96,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM96,56a32,32,0,0,1,64,0V80H96ZM208,208H48V96H208V208Zm-68-56a12,12,0,1,1-12-12A12,12,0,0,1,140,152Z"></path>
                    </svg>
                    <label for="password" class="block ml-2">Contraseña</label>
                </div>
                <input id="password" name="password" type="password" placeholder="Password de registro "
                    class="w-full p-2 pl-8 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') @enderror" value="{{old('password')}}"/>
            </div>
            
            <div>
                <input type="submit" value="Iniciar Sesion"
            class="bg-gray-800 hover:bg-blue-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </div>
        </form>
    </div>
</div>

@endsection