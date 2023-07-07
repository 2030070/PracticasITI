{{-- Se tiene el contenido principal para la estructura de layouts.app.blade.php --}}
@extends('layouts.app')

{{-- seccion para el titulo --}}
@section('titulo')
    Empresa Receptora
@endsection

{{-- seccion para un encabezado donde se centran dos botones para poder ver y navegar por el sitio web el cual 
    se les asigna iconos representativos --}}
@section('nav')
    <nav class="flex justify-center items-center mb-4 bg-blue-500">
        <div class="flex items-center mr-6" title="Dashboard">
            <a href="{{ route('post_index')}}" class="flex items-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#FFFFFF" viewBox="0 0 256 256">
                    <path d="M207.06,80.67A111.24,111.24,0,0,0,128,48h-.4C66.07,48.21,16,99,16,161.13V184a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V160A111.25,111.25,0,0,0,207.06,80.67ZM224,184H119.71l54.76-75.3a8,8,0,0,0-12.94-9.42L99.92,184H32V161.13c0-3.08.15-6.12.43-9.13H56a8,8,0,0,0,0-16H35.27c10.32-38.86,44-68.24,84.73-71.66V88a8,8,0,0,0,16,0V64.33A96.14,96.14,0,0,1,221,136H200a8,8,0,0,0,0,16h23.67c.21,2.65.33,5.31.33,8Z">
                    </path>
                </svg>
            </a>
        </div>

        <div class="flex items-center ml-6" title="Consultar Emisora">
            <a href="{{ route('empresas_receptoras.index')}}" class="flex items-center text-white" >
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#FFFFFF" viewBox="0 0 256 256">
                    <path d="M32,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H40A8,8,0,0,1,32,64Zm8,72h72a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16Zm88,48H40a8,8,0,0,0,0,16h88a8,8,0,0,0,0-16Zm109.66,13.66a8,8,0,0,1-11.32,0L206,177.36A40,40,0,1,1,217.36,166l20.3,20.3A8,8,0,0,1,237.66,197.66ZM184,168a24,24,0,1,0-24-24A24,24,0,0,0,184,168Z">
                    </path>
                </svg>
            </a>
        </div>
    </nav>
@endsection

@section('contenido')
    @auth
        <div class="flex justify-center items-center">
            <div class="w-full md:w-5/12 rounded-lg bg-blue-50 p-6 shadow-xl" >
                <h1 class="text-center text-3xl font-bold mb-12 text-blue-500 ">Formulario de Registro</h1>
                <form method="POST" action="{{ route('empresas_receptoras.store') }}" class="space-y-4">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nombre" class="mb-2 block uppercase font-bold">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" placeholder="Escribe el nombre Receptor" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nombre') border-red-500 @enderror" value="{{old('nombre')}}">
                        @error('nombre')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="direccion" class="mb-2 block uppercase font-bold">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" placeholder="Escribe la dirección" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('direccion') border-red-500 @enderror" value="{{old('direccion')}}">
                        @error('direccion')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="rfc" class="mb-2 block uppercase font-bold">RFC:</label>
                        <input type="text" id="rfc" name="rfc" placeholder="Escribe el RFC" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('rfc') border-red-500 @enderror" value="{{old('rfc')}}">
                        @error('rfc')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="contacto" class="mb-2 block uppercase font-bold">Contacto:</label>
                        <input type="text" id="contacto" name="contacto" placeholder="Escribe el contacto" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contacto') border-red-500 @enderror" value="{{old('contacto')}}">
                        @error('contacto')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="mb-2 block uppercase font-bold">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Escribe el email" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" value="{{old('email')}}">
                        @error('email')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <input type="submit" value="Registrar"
                    class="bg-blue-500 hover:bg-blue-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                    </div>
                </form>
            </div>
        </div>
    @endauth
@endsection
