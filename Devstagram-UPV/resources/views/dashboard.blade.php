@extends('layouts.app')

@section('titulo')
    Perfil: {{$user->username}}
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
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex" style="margin-top: 1cm;">
            
            <div class="md:w8/12 lg:w-6/12 px-10">
                <img src="{{asset('img/usuario.svg')}}" alt="Imagen de Usuario"/>
            </div>
            <div class="md:w8/12 lg:w-6/12 px-5 flex flex-col items-center md:justify-center md:items-start py-10 md:py-10">
                <p class="text-gray-700 text-2x1">{{auth()->user()->username}}</p>
                {{-- Agregando estructura base para dahboard de publlicaciones --}}
                <p class="text-gray-500 text-sm mb-3 font-bold mt-5">
                    <spam class="font-normal"> 
                       0 Seguidores
                    </spam>
                </p>
                <p class="text-gray-500 text-sm mb-3 font-bold mt-5">
                    <spam class="font-normal"> 
                        0 Siguiendo
                    </spam>
                </p>
                <p class="text-gray-500 text-sm mb-3 font-bold mt-5">
                    <spam class="font-normal"> 
                        0 Post
                    </spam>
                </p>
            </div>
        </div>
    </div>
    <section class="conteit mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        @if($posts->count())
            {{-- listamos publicaciones --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a>
                            <img src="{{ asset('uploads/' . $post->imagen) }}" alt="Imagen del post {{ $post->titulo }}" class="img-thumbnail rounded">
                        </a>                        
                    </div>
                @endforeach
            </div>
            <div class="mt-10 justify-end">
                <nav class="flex justify-end">
                    {{$posts->links()}}
                </nav>
            </div>
        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold"> 
                No hay publicaciones
            </p>
        @endif
    </section>
    {{-- Contenido para mostrar la tabla de contenido respectivo de los (post) --}}
    {{-- <div class="flex justify-center" >
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex" style="margin-top: 1cm;">
            <table class="bg-gradient-to-br from-blue-100 to-purple-100" style=" border-radius: 20px; ">
                <thead>
                    <tr>
                        <th class="text-tornasol px-2 py-3 font-mono text-center text-lg">ID</th>
                        <th class="text-tornasol px-2 py-3 font-mono text-center text-lg">Título</th>
                        <th class="text-tornasol px-2 py-3 font-mono text-center text-lg">Descripción</th>
                        <th class="text-tornasol px-2 py-3 font-mono text-center text-lg">Imagen</th>
                    </tr>
                </thead>
                <tbody> --}}
                    {{-- Se obtienen los datos para luego mostrarlos en la tabla --}}
                    {{-- @foreach ($posts as $post)
                        <tr>
                            <td class="px-4 py-2 text-right text-blue-500">{{ $post->user_id }}</td>
                            <td class="px-4 py-2 text-blue-500">{{ $post->titulo }}</td>
                            <td class="px-4 py-2 text-blue-500">{{ $post->descripcion }}</td>
                            <td class="px-4 py-2">
                                <img src="{{ asset('uploads/' . $post->imagen) }}" alt="Imagen del post {{ $post->titulo }}" class="img-thumbnail" style="width: 100px">
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <br>
        </div>
    </div> --}}

    <div style="height: 2cm;"></div>

    

@endsection