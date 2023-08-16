@extends('layouts.app')

@section('titulo')
   Listado de Productos
@endsection


@push('styles')
<style>
    /* Estilos para los botones Anterior y Siguiente */
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
    .dataTables_wrapper .dataTables_paginate .paginate_button.next {
        padding: 0.5rem 1rem;
        background-color: rgba(59, 130, 246, 0.13);
        border-radius: 9999px;
        color: #3B82F6;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Estilos para el margen entre los botones de paginación */
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        margin: 0 0.25rem;
    }

    /* Estilo para el buscador con borde redondeado y color de borde #3B82F6 */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 9999px;
        border: 2px solid #3B82F6;
        background-color: rgba(59, 130, 246, 0.13);
        padding: 0.5rem;
    }


    /* Alinear los botones de paginación debajo de la tabla */
    .dataTables_wrapper .dataTables_paginate {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1rem;
    }
        /* New styles to align search input and "Mostrar registros por página" text in the same row */
        .dataTables_wrapper .dataTables_length {
        display: flex;
        align-items: center;
    }

</style>
@endpush

@section('contenido')
<div class="container mx-auto ">
    <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
        <div class="col-span-1/2 md:col-span-1/2"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-2 md:col-span-5">
            <div class="my-4 flex justify-end space-x-2">
                <form action="{{ route('producto.importar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="archivo_csv">Selecciona un archivo CSV:</label>
                    <input type="file" name="archivo_csv" accept=".csv">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" type="submit">Importar</button>
                  </form>
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
                <a href="{{ route('productos.create') }}" class="inline-block ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-purple-400">
                    <i class="fas fa-plus mr-2"></i> Registrar Producto
                </a>
            </div>
            @if(session('success'))
                    <div class="bg-green-200 p-2 rounded-lg mb-6 text-black text-center ">
                        {{ session('success') }}
                    </div>
            @endif
            @if(session('actualizada'))
                <div class="bg-green-200 p-2 rounded-lg mb-6 text-black text-center ">
                    {{ session('actualizada') }}
                </div>
            @endif
            <div class="overflow-x-auto">
                <table id="productos-table" class="min-w-full border-2 border-blue-500 rounded-lg">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Imagen</th>
                            <th class="py-2 px-4 border-b text-left">Categoría</th>
                            <th class="py-2 px-4 border-b text-left">Subcategoría</th>
                            <th class="py-2 px-4 border-b text-left">Nombre</th>
                            <th class="py-2 px-4 border-b text-left">Precio Compra</th>
                            <th class="py-2 px-4 border-b text-left">Precio Venta</th>
                            <th class="py-2 px-4 border-b text-left">Stock</th>
                            <th class="py-2 px-4 border-b text-left">Marca</th>
                            <th class="py-2 px-4 border-b text-left">Creado por</th>
                            <th class="py-2 px-4 border-b text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td class="py-2 px-4 border-b text-left">
                                <img src="{{ asset('uploads/' . $producto->imagen) }}" alt="Imagen del producto" class="w-20 h-20 object-cover rounded-lg">
                            </td>
                            <td class="py-2 px-4 border-b">{{ $producto->categoria->nombre }}</td>
                            <td class="py-2 px-4 border-b">
                                @if ($producto->subcategoria)
                                    {{ $producto->subcategoria->nombre }}
                                @else
                                    <!-- Valor predeterminado o campo vacío si no hay subcategoría -->
                                   Sin subcategoría
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">{{ $producto->nombre }}</td>
                            <td class="py-2 px-4 border-b">${{ $producto->precio_compra }}</td>
                            <td class="py-2 px-4 border-b">${{ $producto->precio_venta }}</td>
                            <td class="py-2 px-4 border-b">{{ $producto->unidades_disponibles }}</td>
                            <td class="py-2 px-4 border-b">
                                @if ($producto->marca)
                                    {{ $producto->marca->nombre }}
                                @else
                                    <!-- Valor predeterminado o campo vacío si no hay marca -->
                                   Sin marca
                                @endif
                            </td>
                            <td class="py-2 px-4 border-b">{{ $producto->creado_por }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex justify-between items-center">
                                        <a href="{{route('productos.detalle',$producto->id)}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="green" viewBox="0 0 256 256">
                                                <path d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                                                </path>
                                            </svg>
                                        </a>
                                        <a href="{{ route('productos.edit', $producto->id) }}" >
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#3B82F6" viewBox="0 0 256 256">
                                                <path d="M227.32,73.37,182.63,28.69a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31l83.67-83.66,3.48,13.9-36.8,36.79a8,8,0,0,0,11.31,11.32l40-40a8,8,0,0,0,2.11-7.6l-6.9-27.61L227.32,96A16,16,0,0,0,227.32,73.37ZM48,179.31,76.69,208H48Zm48,25.38L51.31,160,136,75.31,180.69,120Zm96-96L147.32,64l24-24L216,84.69Z"></path>
                                            </svg>
                                        </a>
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
                                </div>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#productos-table').DataTable({
            "paging": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50, 100], // Control the number of records shown per page
            "language": {
                "search": "Buscar:",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(filtrado de _MAX_ registros en total)",
                "paginate": {
                    "first": "Primera",
                    "last": "Última",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });
</script>
@endpush