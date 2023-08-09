@extends('layouts.app')

@section('titulo')
   Detalle de Productos
@endsection


@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">
            <div class="rounded-lg overflow-hidden shadow-lg bg-gray-100 transition-transform transform hover:scale-105">
                <div class="grid grid-cols-2 gap-3">
                    <!-- Columna izquierda: Imagen y Nombre -->
                    <div class="col-span-1 p-4 flex flex-col items-center justify-center rounded-xl bg-blue-100">
                        <h2 class="text-xl font-semibold mb-4">{{ $producto->nombre }}</h2>
                        <img src="{{ asset('uploads/' . $producto->imagen) }}" alt="Imagen del producto" class="w-full h-auto object-cover rounded-lg mb-0">
                        <img src="{{ asset('img/codbarras.png') }}" class="w-32 h-32 mt-4">
                    </div>
        
                    <!-- Columna derecha: Resto de los detalles -->
                    <div class="col-span-1 p-4">
                        <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
                        <p><strong>Subcategoría:</strong>
                            @if ($producto->subcategoria)
                                {{ $producto->subcategoria->nombre }}
                            @else
                                Sin subcategoría
                            @endif
                        </p>
                        <p><strong>Precio de Compra:</strong> ${{ $producto->precio_compra }}</p>
                        <p><strong>Precio de Venta:</strong> ${{ $producto->precio_venta }}</p>
                        <p><strong>Unidades Disponibles:</strong> {{ $producto->unidades_disponibles }}</p>
                        <p><strong>Marca:</strong>
                            @if ($producto->marca)
                                {{ $producto->marca->nombre }}
                            @else
                                Sin marca
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <div class="col-span-1 md:col-span-1">
            <div class="sticky top-0 h-screen p-4 rounded-lg">
                <div class="flex flex-col items-center gap-2 bg-blue-500/13 rounded-lg p-2">
                    <a href="{{route('productos.show')}}">
                        <img src="{{ asset('img/productos.png') }}" alt="Imagen" class="w-28 h-28 rounded-sm">
                        <h3 class="text-center text-blue-700 text-sm">Ver Productos</h3>
                    </a> 
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection