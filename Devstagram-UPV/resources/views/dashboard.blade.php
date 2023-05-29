@extends('layouts.app')

@section('titulo')
    TU cuenta de Devstagram-UPV
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-12 md:flex">
            
            <div class="md:w8/12 lg:w-6/12 px-10">
                <img src="{{asset('img/usuario.svg')}}" alt="Imagen de Usuario"/>
            </div>
            <div class="md:w8/12 lg:w-6/12 px-5">
                <p class="text-gray-700 text-2x1">{{auth()->user()->username}}</p>
            </div>
        </div>
    </div>

@endsection