@extends('layouts.app')

@section('titulo')
   Registrar Categoría
@endsection

@section('contenido')
<div class="container mx-auto">
    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg py-10">
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf

                <div>
                    <label for="codigo" class="block font-medium text-sm text-gray-700">Código:</label>
                    <input type="text" name="codigo" id="codigo" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mt-4">
                    <label for="descripcion" class="block font-medium text-sm text-gray-700">Descripción:</label>
                    <input type="text" name="descripcion" id="descripcion" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mt-4">
                    <label for="creado_por" class="block font-medium text-sm text-gray-700">Creado por:</label>
                    <input type="text" name="creado_por" id="creado_por" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <input type="submit" value="Registrar"
                        class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 
                        hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md 
                        bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
