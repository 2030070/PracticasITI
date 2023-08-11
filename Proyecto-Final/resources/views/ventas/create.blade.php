@extends('layouts.app')


@push('styles')
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
@endpush

@section('titulo')
Ventas
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-5 gap-5">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-4">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div >
                    <form id="filtroForm" method="GET" action="{{ route('ventas.create') }}" class="px-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="flex-grow my-2">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 bg-blue-500/13 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="nombre" placeholder="Nombre del producto">
                            </div>
                            <div class="flex-grow my-2">
                                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-blue-500/13" name="categoria_id">
                                    <option value="">Categoría</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex-grow my-2">
                                <select class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-blue-500/13" name="subcategoria_id">
                                    <option value="">Subcategoría</option>
                                    @foreach($subcategorias as $subcategoria)
                                    <option value="{{ $subcategoria->id }}">{{ $subcategoria->descripcion }}</option>
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
                    
                    {{-- INICIO --}}
                    <div class="flex">
                        <div style="width: 80%;">
                            

                            <!-- Listado de productos -->
                            <div id="productosContainer" class="flex flex-wrap">
                                @foreach($productos as $producto)
                                <button data-producto-id="{{ $producto->id }}" style="width: 30%; margin: 7px;" class="btn-agregar">
                                    <div class="flex flex-col items-center shadow rounded bg-gray-300 hover:bg-blue-100 transition-transform duration-200 product-card cursor-pointer transform hover:scale-105">
                                        <img style="width: 80%; margin-top: 10px;" class="h-26 object-cover rounded border border-white" src="{{ asset('uploads/'.$producto->imagen) }}" alt="{{ $producto->nombre }}">
                                        <h2 class="text-lg font-semibold text-gray-700 uppercase">{{ $producto->nombre }}</h2>
                                        <p class=" text-gray-600">{{ $producto->unidades_disponibles }}</p>
                                        <p class=" text-gray-600">${{ $producto->precio_venta }}</p>
                                    </div>
                                </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="width:20%;">
                            <!-- Carrito -->
                                <div class="rounded bg-blue-500/13 p-6">
                                    <h3 class="pl-6 pt-6 text-2xl font-semibold text-gray-700">Carrito</h3>
                                    <div class="p-6 grid grid-cols-1 gap-6">
                                        <div id="carritoContainer" style="max-height: 40vh; overflow-y: auto;" class="grid grid-cols-1 gap-6"></div>

                                        <!-- Subtotal, impuestos y total -->
                                        <div id="totalDiv" class="shadow p-4 rounded bg-blue-200/13">
                                            <p class="text-lg font-semibold text-gray-700">Subtotal: $0</p>
                                            <p class="text-lg font-semibold text-gray-700">IVA (16%): $0</p>
                                            <p class="text-lg font-semibold text-gray-700">Total: $0</p>
                                        </div>

                                        <!-- Botón para guardar la venta -->
                                        <form method="POST" action="{{ route('ventas.store') }}">
                                            @csrf
                                            <!-- Campo para el correo del cliente -->
                                            <input style="margin-top: 10px;" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="correo_cliente" placeholder="Correo del cliente">
                                            <!-- Campo para el pago -->
                                            <input style="margin-top: 10px;" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="pago" placeholder="Pago">
                                            <!-- Campos ocultos para subtotal, impuestos y total -->
                                            <input type="hidden" name="subtotal" value="0">
                                            <input type="hidden" name="impuestos" value="0">
                                            <input type="hidden" name="total" value="0">
                                            <button class="btn-custom w-full py-2 px-4 rounded focus:outline-none mt-4 text-white bg-green-300">Registrar venta</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral --> --}}
          
    </div>
</div>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var imagesBasePath = '{{ asset('uploads') }}';
        $(document).ready(function() {

            $.ajax({
                url: '{{ route('ventas.cart') }}',
                type: 'GET',
                success: function(response) {
                    updateCart(response.cart);
                },
                error: function() {
                    // Manejar errores
                }
            });

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

            $('.btn-agregar').on('click', function() {
                var productoId = $(this).data('producto-id');

                $.ajax({
                    url: '{{ route('ventas.agregar') }}',
                    type: 'POST',
                    data: {
                        producto_id: productoId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Actualizar la vista del carrito
                        updateCart(response.cart);
                    },
                    error: function() {
                        // Manejar errores
                    }
                });
            });

            $(document).on('click', '.btn-eliminar', function() {
                var productoId = $(this).data('producto-id');

                $.ajax({
                    url: '{{ route('ventas.eliminar') }}',
                    type: 'POST',
                    data: {
                        producto_id: productoId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Actualizar la vista del carrito
                        updateCart(response.cart);
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
                var productoDiv = '<button data-producto-id="' + producto.id + '" style="width: 30%; margin: 10px" class ="btn-agregar">' +
                    '<div class="flex flex-col items-center shadow rounded bg-gray-300 hover:bg-blue-100 transition-transform duration-200 product-card cursor-pointer transform hover:scale-105">' +
                        '<img  style="width: 80%; margin-top: 10px;" class="h-26 object-cover rounded" src="' + '{{ asset('uploads') }}' + '/' + producto.imagen + '" alt="' + producto.nombre + '">' +
                        '<h2 class=" text-xl font-semibold text-gray-700 uppercase">' + producto.nombre + '</h2>' +
                        '<p class=" text-gray-600">' + producto.unidades_disponibles + '</p>' +
                        '<p class=" text-gray-600">$' + producto.precio_venta + '</p>' +
                    '</div>' +
                '</button>';

                productosContainer.append(productoDiv);
            });

            // Reasignar el evento click a los botones de agregar luego de haber actualizado los productos
            $('.btn-agregar').on('click', function() {
                var productoId = $(this).data('producto-id');

                $.ajax({
                    url: '{{ route('ventas.agregar') }}',
                    type: 'POST',
                    data: {
                        producto_id: productoId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Actualizar la vista del carrito
                        updateCart(response.cart);
                    },
                    error: function() {
                        // Manejar errores
                    }
                });
            });
        }


        function updateCart(cart) {
            // Contenedor para los productos en el carrito
            var carritoContainer = $('#carritoContainer');
            carritoContainer.empty();
            var subtotal = 0;

            if (!Array.isArray(cart)) {
                cart = Object.values(cart);
            }

            // Agrega un nuevo div para cada producto en el carrito
            cart.forEach(function(producto) {
                var productoTotal = producto.precio * producto.cantidad;
                var productoDiv =
                '<div class="shadow p-4 rounded flex items-center justify-between">' +
                '<div>' +
                    '<h2 class="text-lg font-semibold text-gray-700">' + producto.cantidad + ' x ' + producto.nombre + '</h2>' +
                    '<p class="text-gray-600">$' + productoTotal + '</p>' +
                '</div>' +
                '<img src="' + imagesBasePath + '/' + producto.imagen + '" alt="Product Image" class="h-10 w-10 object-cover rounded-lg">'+
                '<button data-producto-id="' + producto.producto_id + '" class="btn-eliminar text-gray-100 bg-red-500 btn-custom pt-2 pl-2 pr-2 pb-2 rounded focus:outline-none">Eliminar</button>' +
            '</div>';

                carritoContainer.append(productoDiv);
                subtotal += productoTotal;
            });

            // Calcular impuestos y total
            var impuestos = subtotal * 0.16;
            var total = subtotal + impuestos;

            // Actualizar subtotal, impuestos y total en el div correspondiente
            var totalesDiv = $('#totalDiv');
            totalesDiv.empty();
            totalesDiv.append('<p class="text-lg font-semibold text-gray-700">Subtotal: $' + subtotal.toFixed(2) + '</p>');
            totalesDiv.append('<p class="text-lg font-semibold text-gray-700">IVA (16%): $' + impuestos.toFixed(2) + '</p>');
            totalesDiv.append('<p class="text-lg font-semibold text-gray-700">Total: $' + total.toFixed(2) + '</p>');

            // Actualizar subtotal, impuestos y total en los campos ocultos
            $('input[name="subtotal"]').val(subtotal.toFixed(2));
            $('input[name="impuestos"]').val(impuestos.toFixed(2));
            $('input[name="total"]').val(total.toFixed(2));
        }

        $(document).ready(function(){
            $(".product-card").click(function(){
                $(this).closest("form").submit();
        });
    });

</script>
@endpush
