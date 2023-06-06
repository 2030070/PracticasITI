@extends('auth.dashboard')
{{-- @vite('resources/css/app.css') --}}
@section('tables')
    <!-- Contenido de la página donde se muestra la tabla de usuarios-->

    <div class="md:flex md:justify-center md:gap-10 md:items-center" >

        <div class="md:w-12/12 p-15 rounded-xl shadow-xl flex bg-gray-300">
            <div class="flex-1">
                <div class="p-6">
                    <h1 class="text-4xl font-bold text-center text-cyan-700">Eliminar productos</h1>

                    <table class="mt-6 w-full bg-white border-2 border-cyan-800">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">ID</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Nombre</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Descripción Corta</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Descripción Larga</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Precio de Venta</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Precio de Compra</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Stock</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Fecha</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700">Peso</th>
                                <th class="px-4 py-2 border-b-2 border-cyan-700"> </th> <!-- Columna para botón de eliminar -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí itera sobre los productos y mostrar cada fila en la tabla -->
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-4 py-2">{{ $product->id }}</td>
                                    <td class="px-4 py-2">{{ $product->name }}</td>
                                    <td class="px-4 py-2">{{ $product->short_description }}</td>
                                    <td class="px-4 py-2">{{ $product->long_description }}</td>
                                    <td class="px-4 py-2">{{ $product->sale_price }}</td>
                                    <td class="px-4 py-2">{{ $product->purchase_price }}</td>
                                    <td class="px-4 py-2">{{ $product->stock }}</td>
                                    <td class="px-4 py-2">{{ $product->fecha }}</td>
                                    <td class="px-4 py-2">{{ $product->peso }}</td>
                                    <td class="px-4 py-2">
                                        <form action="{{ route('delete_product_table', ['id' => $product->id]) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-800 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded-lg">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endsection
