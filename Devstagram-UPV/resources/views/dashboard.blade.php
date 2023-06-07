@extends('layouts.app')

@section('titulo')
    TU cuenta de Devstagram-UPV
@endsection

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

@endsection