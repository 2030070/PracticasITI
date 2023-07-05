@extends('layouts.app')

@section('titulo')
   Consultar Categorías
@endsection

@section('contenido')
<div class="container mx-auto px-4  ">
    <div class="overflow-x-auto  py-20">
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Código</th>
                    <th class="py-2 px-4 border-b">Descripción</th>
                    <th class="py-2 px-4 border-b">Creado por</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $categoria->codigo }}</td>
                    <td class="py-2 px-4 border-b">{{ $categoria->descripcion }}</td>
                    <td class="py-2 px-4 border-b">{{ $categoria->creado_por }}</td>
                    <td class="py-2 px-4 border-b">
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $categorias->links() }}
    </div>
</div>
@endsection
