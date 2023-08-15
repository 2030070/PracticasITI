@extends('layouts.app')

@section('titulo')
   Crear Compra
@endsection

@push('styles')
<style>
    .product-tag {
        transition: transform 0.2s, background-color 0.2s;
    }
    .product-tag:hover {
        transform: scale(1.05);
        background-color: #BFDBFE; /* Cambia el color a blue-300 */
    }
</style>
   
@endpush

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-2 md:col-span-3 md:flex-wrap">
                {{-- Mensaje --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('mensaje') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('mensaje'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('warning') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form id="filtroForm" method="GET" class="flex flex-wrap justify-between px-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="flex-grow my-2">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-blue-500/13 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="nombre" placeholder="Nombre del producto">
                        </div>
                        <div class="flex-grow my-2">
                            <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-blue-500/13" name="categoria_id">
                                <option value="">Categoría</option>
                                @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow my-2">
                            <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-blue-500/13" name="subcategoria_id">
                                <option value="">Subcategoría</option>
                                @foreach($subcategorias as $subcategoria)
                                <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow my-2">
                            <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-blue-500/13" name="marca_id">
                                <option value="">Marca</option>
                                @foreach($marcas as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="flex-grow my-2">
                            <div class="flex-grow my-2">
                                <button class="btn-custom w-full py-2 px-4 rounded text-gray-100 focus:outline-none bg-blue-500" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="productosContainer" class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    @foreach ($todosLosProductos as $producto)
                        <div class="bg-blue-500/13 text-white font-bold py-2 px-8 rounded-lg product-tag product-item flex flex-col items-center">
                            <img src="{{ asset('uploads/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-40 object-cover rounded-md mb-4">
                                <h3 class="text-xl font-semibold uppercase">{{ $producto->nombre }}</h3>
                                <p class="text-gray-600"><span class="font-bold">Precio:</span> ${{ $producto->precio_compra }}</p>
                                <p class="text-gray-600"><span class="font-bold">Stock:</span> {{ $producto->unidades_disponibles }}</p>
                                <a href="{{ route('compras.formulario', ['producto' =>  $producto->id  ]) }}">
                                    <button data-producto-id="{{$producto->id}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg btn-agregar">
                                        <i class="fas fa-cart-plus"></i>
                                </a>
                        </div>
                    @endforeach
                </div>


                        </div>
                    </div>
                    <div class="col-span-1 md:col-span-1"></div>
                </div>
            </div>

@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var imagesBasePath = '{{ asset('uploads') }}';

    $(document).ready(function() {
        $('#filtroForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route('ventas.filtro') }}',
                type: 'GET',
                data: $(this).serialize(),
                success: function(response) {
                    // Actualiza los productos en la vista
                    updateProducts(response.productos);
                },
                error: function() {
                    // Manejar errores
                }
            });
        });
    });

    function updateProducts(productos) {
        // Contenedor para los productos
        var productosContainer = $('#productosContainer');
        productosContainer.empty();

        // Agrega un nuevo div para cada producto
        productos.forEach(function(producto) {
            var productoId = producto.id;

            var productoDiv = `
                <div class="bg-blue-500/13 text-white font-bold py-2 px-8 rounded-lg product-tag product-item flex flex-col items-center">
                    <img src="{{ asset('uploads') }}/${producto.imagen}" alt="${producto.nombre}" class="w-full h-48 object-cover rounded-md mb-4">
                    <h3 class="text-xl font-semibold uppercase">${producto.nombre}</h3>
                    <p class="text-gray-600"><span class="font-bold">Precio de Compra:</span> $${producto.precio_compra}</p>
                    <p class="text-gray-600"><span class="font-bold">Unidades Disponibles:</span> ${producto.unidades_disponibles}</p>
                    <a href="{{ route('compras.formulario', ['producto' => '__PRODUCTOID__' ]) }}" class="btn-agregar">
                        <button data-producto-id="${producto.producto_id}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </a>
                </div>`;

            // Reemplazar "__PRODUCTOID__" con el valor real del productoId en el enlace
            productoDiv = productoDiv.replace('__PRODUCTOID__', productoId);

                productosContainer.append(productoDiv);
            });


    }
</script>

@endpush
