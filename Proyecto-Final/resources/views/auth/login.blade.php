@extends('layouts.app')

@section('titulo')
    Dashboard 
@endsection

@section('contenido')
<style>
    body {
        background-image: url('img/fondo2.jpg');
        background-size: cover;
    }
</style>
<body>
    <div class="flex justify-center items-center" >
        <div class="w-full sm:w-2/3 md:w-2/3  xl:w-1/3 rounded-lg bg-white p-6 shadow-xl relative">
            <div class="absolute  top-0 left-1/4 bg-blue-800 justify-center text-white px-4 py-4 rounded">

                <h1 class="text-center text-3xl font-bold">Iniciar sesión</h1>
            </div>
    
            <form method="POST" action="{{route('login')}}" class="space-y-14">
                @csrf
                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{session('mensaje')}}
                    </p>
                @endif
                <div class="mb-5">
                    <div class="flex items-center bg-blue-800 rounded-lg text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#ffffff" viewBox="0 0 256 256">
                            <path d="M230.92,212c-15.23-26.33-38.7-45.21-66.09-54.16a72,72,0,1,0-73.66,0C63.78,166.78,40.31,185.66,25.08,212a8,8,0,1,0,13.85,8c18.84-32.56,52.14-52,89.07-52s70.23,19.44,89.07,52a8,8,0,1,0,13.85-8ZM72,96a56,56,0,1,1,56,56A56.06,56.06,0,0,1,72,96Z"></path>
                        </svg>
                        <input id="email" name="email" type="text" placeholder="Tu email de registro" required
                            class="w-full p-4 pl-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 @error('email') border-red-500 @enderror" value="{{old('email')}}" />
                    </div>
                </div>
                <div class="mb-5">
                    <div class="flex items-center bg-blue-800 rounded-lg text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#ffffff" viewBox="0 0 256 256">
                            <path d="M208,80H176V56a48,48,0,0,0-96,0V80H48A16,16,0,0,0,32,96V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V96A16,16,0,0,0,208,80ZM96,56a32,32,0,0,1,64,0V80H96ZM208,208H48V96H208V208Zm-68-56a12,12,0,1,1-12-12A12,12,0,0,1,140,152Z"></path>
                        </svg>
                        <input id="password" name="password" type="password" placeholder="Password de registro" required
                            class="w-full p-4 pl-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400  @error('password') border-red-500 @enderror" value="{{old('password')}}" />
                    </div>
                </div>
    
                <div>
                    <input type="submit" value="Iniciar Sesión"
                        class="bg-blue-800 hover:bg-blue-900 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                </div>
            </form>
        </div>
    </div>
    
</body>
@endsection
