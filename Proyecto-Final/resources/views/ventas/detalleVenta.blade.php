@extends('layouts.app')

@section('titulo')
    Detalles de la Venta
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-2 md:col-span-3 md:flex-wrap">
            <div class="my-4 flex justify-end space-x-2">
                @auth
                <button onclick="exportToPDF('reporte')" class="inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-blue-500 hover:bg-blue-500/13 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffffff" viewBox="0 0 256 256">
                        <path d="M224,152a8,8,0,0,1-8,8H192v16h16a8,8,0,0,1,0,16H192v16a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8h32A8,8,0,0,1,224,152ZM92,172a28,28,0,0,1-28,28H56v8a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8H64A28
                        ,28,0,0,1,92,172Zm-16,0a12,12,0,0,0-12-12H56v24h8A12,12,0,0,0,76,172Zm88,8a36,36,0,0,1-36,36H112a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8h16A36,36,0,0,1,164,180Zm-16,0a20,20,0,0,0-20-20h-8v40h8A20,
                        20,0,0,0,148,180ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,0,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.69L160,51.31Z"></path>
                    </svg>
                </button>
        
                <button onclick="exportToExcel('reporte')" class="inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-blue-500 hover:bg-blue-500/13 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffffff" viewBox="0 0 256 256"><path d="M156,208a8,8,0,0,1-8,8H120a8,8,0,0,1-8-8V152a8,8,0,0,1,16,0v48h20A8,8,0,0,1,156,208ZM92.65,
                        145.49a8,8,0,0,0-11.16,1.86L68,166.24,54.51,147.35a8,8,0,1,0-13,9.3L58.17,180,41.49,203.35a8,8,0,0,0,13,9.3L68,193.76l13.49,18.89a8,8,0,0,0,13-9.3L77.83,180l16.68-23.35A8,8,0,0,0,92.65,145.49Zm98.94,
                        25.82c-4-1.16-8.14-2.35-10.45-3.84-1.25-.82-1.23-1-1.12-1.9a4.54,4.54,0,0,1,2-3.67c4.6-3.12,15.34-1.72,19.82-.56a8,8,0,0,0,4.07-15.48c-2.11-.55-21-5.22-32.83,2.76a20.58,20.58,0,0,0-8.95,14.95c-2,15.88,
                        13.65,20.41,23,23.11,12.06,3.49,13.12,4.92,12.78,7.59-.31,2.41-1.26,3.33-2.15,3.93-4.6,3.06-15.16,1.55-19.54.35A8,8,0,0,0,173.93,214a60.63,60.63,0,0,0,15.19,2c5.82,0,12.3-1,17.49-4.46a20.81,20.81,0,0,0,
                        9.18-15.23C218,179,201.48,174.17,191.59,171.31ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,1,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.68L160,51.31Z"></path>
                    </svg>
                </button>    
                @endauth
                
            </div>
            <div class="container mx-auto mt-10" id="maintable">
                
                <h2 class="text-2xl font-bold mb-4 justify-center">Ticket de venta</h2>
                <p class="flex justify-end "><strong>Fecha:</strong> {{ $ventas->created_at }}</p>
                <div class="flex">
                    <div class="w-1/3 p-4 bg-blue-500/13">
                        <p><strong>Cliente:</strong> {{ $ventas->cliente->nombre}}</p>
                        <p><strong>Vendedor:</strong> {{ $ventas->vendedor->name }}</p>
                    </div>
                    <div class="w-1/3 p-4 bg-gray-100 ">
                        <p><strong>Subtotal:</strong> ${{ $ventas->total - ($ventas->total * 0.16)}}</p>
                        <p><strong>IVA:</strong> ${{ $ventas->total * 0.16}}</p>
                        <p><strong>Total Venta:</strong> ${{ $ventas->total }}</p>
                    </div>
                    <div class="w-1/3 p-4 bg-blue-500/13">
                        <p><strong>Monto pagado:</strong> ${{ $ventas->pago }}</p>
                        <p><strong>Cambio:</strong> ${{ $ventas->pago - $ventas->total }}</p>
                    </div>
                  </div>
                <table class="table-auto border-collapse w-full border-blue-500 border-2">
                    <h3 class="mt-4">Productos Vendidos:</h3>
                    <thead class="bg-blue-500/13">
                        <tr>
                            <th class="py-2 px-4">Imagen</th>
                            <th class="py-2 px-4">Producto</th>
                            <th class="py-2 px-4">Cantidad</th>
                            <th class="py-2 px-4">Precio Producto</th>
                            <th class="py-2 px-4">Total</th>
                            <th class="py-2 px-4">Devolver</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas->productos as $producto)
                            <tr>
                                <td class="py-2 px-4">
                                    <img src="{{ asset('uploads') . '/' . $producto->imagen }}" class="border-lg" alt="Imagen del producto" width="100">
                                </td>
                                <td class="py-2 px-4">{{ $producto->nombre }}</td>
                                <td class="py-2 px-4">{{ $producto->pivot->cantidad }}</td>
                                <td class="py-2 px-4">${{ $producto->precio_venta }}</td>
                                <td class="py-2 px-4">${{ $producto->pivot->cantidad * $producto->precio_venta }}</td>
                                <td class="py-2 px-4">
                                    <a class="inline-block bg-green-300 rounded-lg px-4 py-2 border border-green-300 hover:bg-green-400 hover:border-green-400 hover:text-white transition" href="{{ route('devoluciones.create', ['productoId' => $producto->id, 'ventaId' => $ventas->id]) }}">Crear devolución</a>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

