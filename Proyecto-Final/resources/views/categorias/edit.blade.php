@extends('layouts.app')

@section('titulo')
   Editar Categoría
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">
            <div class="">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" novalidate>
                        @method('put')
                        @csrf
                        

                        <div class="mb-4 flex">
                            <div class="w-1/3 mr-2">
                                <label for="codigo" class="block mb-2 font-semibold">Código:</label>
                                <input type="text" name="codigo" id="codigo" placeholder="Ingrese el código" required
                                    class="focus:shadow-primary-outline dark:text-white/80 
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none" value="{{ $categoria->codigo }}">
                            </div>
                            <div class="w-2/3 ml-2">
                                <label for="nombre" class="block mb-2 font-semibold">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre de la categoría" required
                                    class="focus:shadow-primary-outline dark:text-white/80 
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none" value="{{ $categoria->nombre }}">
                            </div>
                        </div>
                        
                        <div class="mb-5">
                            <label for="descripcion" class="block mb-2 font-semibold">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" placeholder="Ingrese la descripción" required
                                class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-7 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none">
                                {{ $categoria->descripcion }}
                            </textarea>
                        </div>

                        <input type="hidden" name="creado_por" value="{{ Auth::user()->name }}">
                        
                        <div>
                            <input type="submit" value="Actualizar"
                                class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 
                                hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md 
                                bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    </div>
</div>
@endsection
