@extends('layouts.app')

@section('titulo')
   Listado de Productos
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="overflow-x-auto py-20">
        <table class="min-w-full border-2 border-blue-500 rounded-lg">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">Categoría</th>
                    <th class="py-2 px-4 border-b text-left">Subcategoría</th>
                    <th class="py-2 px-4 border-b text-left">Precio de Compra</th>
                    <th class="py-2 px-4 border-b text-left">Precio de Venta</th>
                    <th class="py-2 px-4 border-b text-left">Unidades Disponibles</th>
                    <th class="py-2 px-4 border-b text-left">Creado por</th>
                    <th class="py-2 px-4 border-b text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $producto->categoria->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $producto->subcategoria->nombre }}</td>
                    <td class="py-2 px-4 border-b">{{ $producto->precio_compra }}</td>
                    <td class="py-2 px-4 border-b">{{ $producto->precio_venta }}</td>
                    <td class="py-2 px-4 border-b">{{ $producto->unidades_disponibles }}</td>
                    <td class="py-2 px-4 border-b">{{ $producto->creado_por }}</td>
                    <td class="py-2 px-4 border-b">
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red" viewBox="0 0 256 256">
                                    <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $productos->links() }}
    </div>
</div>
@endsection
