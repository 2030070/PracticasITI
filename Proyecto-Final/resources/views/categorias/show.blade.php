@extends('layouts.app')

@section('titulo')
   Consultar Categorías
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
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1/2 md:col-span-1/2"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-2 md:col-span-3">
            <div class="flex justify-end"> <!-- Alineación a la derecha -->
                <a href="{{ route('categorias.create') }}" class="inline-block ml-auto px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-purple-400">
                    <i class="fas fa-plus mr-2"></i> Registrar Categoría
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
                <table id="categorias-table" class="min-w-full border-2 border-blue-500 rounded-lg">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Código</th>
                            <th class="py-2 px-4 border-b text-left">Nombre</th>
                            <th class="py-2 px-4 border-b text-left">Descripción</th>
                            <th class="py-2 px-4 border-b text-left">Creado por</th>
                            <th class="py-2 px-4 border-b text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td class="py-2 px-4 border-b text-right">{{ $categoria->codigo }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $categoria->nombre }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $categoria->descripcion }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $categoria->creado_por }}</td>
                            <td class="py-2 px-4 border-b text-left">
                                <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('categorias.edit', $categoria->id) }}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#3B82F6" viewBox="0 0 256 256">
                                        <path d="M227.32,73.37,182.63,28.69a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31l83.67-83.66,3.48,13.9-36.8,36.79a8,8,0,0,0,11.31,11.32l40-40a8,8,0,0,0,2.11-7.6l-6.9-27.61L227.32,96A16,16,0,0,0,227.32,73.37ZM48,179.31,76.69,208H48Zm48,25.38L51.31,160,136,75.31,180.69,120Zm96-96L147.32,64l24-24L216,84.69Z"></path>
                                    </svg>
                                </a>
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
        $('#categorias-table').DataTable({
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
