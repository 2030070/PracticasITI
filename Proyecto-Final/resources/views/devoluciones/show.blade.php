@extends('layouts.app')

@section('titulo')
   Listado de devoluciones
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
            <div class="flex justify-end"> <!-- Alineación a la derecha -->
                <a href="{{ route('ventas.show') }}" class="inline-block ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-purple-400">
                    <i class="fas fa-plus mr-2"></i> Registrar Devolución
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
                <table  id="devoluciones-table" class="min-w-full border-2 border-blue-500 rounded-lg">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Referencia</th>
                            <th class="py-2 px-4 border-b text-left">Nombre del Producto</th>
                            <th class="py-2 px-4 border-b text-left">Cantidad</th>
                            <th class="py-2 px-4 border-b text-left">Fecha</th>
                            <th class="py-2 px-4 border-b text-left">Creado por</th>
                            <th class="py-2 px-4 border-b text-left">Cliente</th>
                            <th class="py-2 px-4 border-b text-left">Venta</th>
                            <th class="py-2 px-4 border-b text-left">Ver Venta</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($devoluciones as $devolucion)
                        <tr>

                            <td class="py-2 px-4 border-b">{{ $devolucion->referencia }}</td>
                            <td class="py-2 px-4 border-b">{{ $devolucion->producto->nombre }}</td>
                            <td class="py-2 px-4 border-b">{{ $devolucion->cantidad }}</td>
                            <td class="py-2 px-4 border-b">{{ $devolucion->fecha_devolucion }}</td>
                            <td class="py-2 px-4 border-b">{{ $devolucion->creado_por }}</td>
                            <td class="py-2 px-4 border-b">{{ $devolucion->venta->cliente->nombre }}</td>
                            <td class="py-2 px-4 border-b">{{ $devolucion->venta->referencia }}</td>
                            <th class="py-2 px-4 border-b text-left"><a href="{{ route('ventas.detalle', ['id' => $devolucion->venta->id]) }}">Ver Venta</a></th>

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
        $('#devoluciones-table').DataTable({
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
