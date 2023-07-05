@extends('layouts.app')

@section('titulo')
   Crear Producto
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="py-20">
        <form action="{{ route('productos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="categoria_id" class="block mb-2">Categoría:</label>
                <select name="categoria_id" id="categoria_id" class="border rounded-lg py-2 px-4 " placeholder="Seleccione una categoría">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="subcategoria_id" class="block mb-2">Subcategoría:</label>
                <select name="subcategoria_id" id="subcategoria_id" class="border rounded-lg py-2 px-4 " placeholder="Seleccione una subcategoría">
                    <option value="">Seleccione una subcategoría</option>
                    {{-- @foreach ($subcategorias as $subcategoria)
                        <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                    @endforeach --}}
                </select>
            </div>

            <div class="mb-4">
                <label for="precio_compra" class="block mb-2">Precio de Compra:</label>
                <input type="number" name="precio_compra" id="precio_compra" class="border rounded-lg py-2 px-4" step="0.01" min="0" placeholder="Ingrese el precio de compra">
            </div>

            <div class="mb-4">
                <label for="precio_venta" class="block mb-2">Precio de Venta:</label>
                <input type="number" name="precio_venta" id="precio_venta" class="border rounded-lg py-2 px-4" step="0.01" min="0" placeholder="Ingrese el precio de venta">
            </div>

            <div class="mb-4">
                <label for="unidades_disponibles" class="block mb-2">Unidades Disponibles:</label>
                <input type="number" name="unidades_disponibles" id="unidades_disponibles" class="border rounded-lg py-2 px-4" min="0" placeholder="Ingrese las unidades disponibles">
            </div>

            <div class="mb-4">
                <label for="creado_por" class="block mb-2">Creado por:</label>
                <input type="text" name="creado_por" id="creado_por" class="border rounded-lg py-2 px-4" placeholder="Ingrese el creador">
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
@endsection
