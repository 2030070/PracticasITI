@extends('layouts.app')

@push('styles')
    {{-- estilos dropzone --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" /> 
@endpush

@section('titulo')
   Registrar Marca
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">
            <div class="">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="md:w-1/2 px-10">
                        <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded
                        flex flex-col justify-center items-center mb-5" style="border: 4px solid; border-radius: 20px; border-image: linear-gradient(to right, #ff00ff, #00ffff); border-image-slice: 1;">
                            @csrf
                        </form>
                    </div>
                    <form action="{{ route('marcas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-5">
                            <input name="imagen" type="hidden" value="{{old('imagen')}}"/>
                            @error('imagen')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="nombre" class="block mb-2 font-semibold">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre de la marca" required
                                class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        </div>
                      
                        <div class="mb-4">
                            <label for="descripcion" class="block mb-2 font-semibold">Descripción:</label>
                            <input type="text" name="descripcion" id="descripcion" placeholder="Ingrese la descripción" required
                                class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        </div>

                        <input type="hidden" name="creado_por" value="{{ Auth::user()->id }}">

                        <div>
                            <input type="submit" value="Registrar" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    </div>
</div>


@endsection
