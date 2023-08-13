@extends('layouts.app')

@section('titulo')
    Detalles de la Venta
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-2 md:col-span-3 md:flex-wrap">
            <div class="container mx-auto mt-10">
                <h2 class="text-2xl font-bold mb-4">Detalles de la Venta</h2>
                    <p><strong>Cliente:</strong> {{ $ventas->cliente->nombre}}</p>
                    <p><strong>Fecha:</strong> {{ $ventas->created_at }}</p>
                    <p><strong>Subtotal:</strong> ${{ $ventas->total - ($ventas->total * 0.16)}}</p>
                    <p><strong>IVA:</strong> ${{ $ventas->total * 0.16}}</p>
                    <p><strong>Total Venta:</strong> ${{ $ventas->total }}</p>
                    <p><strong>Monto pagado:</strong> ${{ $ventas->pago }}</p>
                    <p><strong>Cambio:</strong> ${{ $ventas->pago - $ventas->total }}</p>
                    <p><strong>Vendedor:</strong> {{ $ventas->vendedor->name }}</p>

                    <h3 class="mt-4">Productos Vendidos:</h3>
                    <table class="border-collapse w-full border border-gray-400">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 border-b">Imagen</th>
                                <th class="py-2 px-4 border-b">Producto</th>
                                <th class="py-2 px-4 border-b">Cantidad</th>
                                <th class="py-2 px-4 border-b">Precio Ind. Producto</th>
                                <th class="py-2 px-4 border-b">Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($producto as $productos)
                                <tr>
                                    <td class="py-2 px-4 border-b">
                                        <img src="{{ asset('uploads') . '/' . $productos->imagen_producto }}" class="rounded-lg " alt="Imagen del producto" width="100">
                                    </td>
                                    <td class="py-2 px-4 border-b">{{ $productos->nombre_producto }}</td>
                                    <td class="py-2 px-4 border-b">{{ $productos->cantidad_vendida }}</td>
                                    <td class="py-2 px-4 border-b">{{ $productos->precio_producto }}</td>
                                    <td class="py-2 px-4 border-b">${{ $productos->precio_producto * $productos->cantidad_vendida }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
