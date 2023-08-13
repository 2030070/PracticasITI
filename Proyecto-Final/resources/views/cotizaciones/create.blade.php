@extends('layouts.app')

@section('titulo')
   Crear Cotizacion
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
                <div id="productosContainer" class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    @foreach ($todosLosProductos as $producto)
                        <div class="bg-blue-500/13 text-white font-bold py-2 px-8 rounded-lg product-tag product-item flex flex-col items-center">
                            <img src="{{ asset('uploads/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-40 object-cover rounded-md mb-4">
                            <h3 class="text-xl font-semibold uppercase">{{ $producto->nombre }}</h3>
                            <p class="text-gray-600"><span class="font-bold">Precio:</span> ${{ $producto->precio_venta }}</p>
                            <p class="text-gray-600"><span class="font-bold">Stock:</span> {{ $producto->unidades_disponibles }}</p>
                            <button data-producto-id="{{ $producto->id }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg btn-agregar">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    @endforeach
                </div>

                <div class="container mx-auto px-4 mt-4 bg-blue-500/13 rounded-lg shadow-lg " id="carrito-container" >
                    <h2 class="text-lg font-semibold mb-2 items-center text-center ">Carrito de Compras</h2>
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Producto</th>
                                <th class="px-4 py-2">Precio del producto</th>
                                <th class="px-4 py-2">Cantidad de productos</th>
                                <th class="px-4 py-2">Subtotal por producto</th>
                                <th class="px-4 py-2"></th> <!-- Add the Actions column -->
                            </tr>
                        </thead>
                        <tbody id="carritoContainer" >

                        </tbody>
                    </table>
                    <!-- Cálculo de total final, IVA y pago neto -->
                    <div class="font-bold text-center">Resumen de la compra</div>
                    <div class="flex justify-center px-4 py-2">
                        <div id="totalDiv" class="text-gray-600">
                        </div>
                    </div>

                    <div class="flex justify-center px-4 py-2">
                        <form method="POST" action="{{ route('cotizacion-store') }}">
                            @csrf
                            <!-- Campo para el correo del cliente -->
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div class="mb-4">
                                    <label for="correo_cliente" class="font-semibold">Cliente</label>
                                    <select id="correo_cliente" name="correo_cliente" class="focus:shadow-primary-outline  dark:placeholder:text-white/80  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-bñue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                        @foreach($clientes as $cliente)
                                            <option value="{{$cliente->correo}}">{{$cliente->correo}}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategoria_id')
                                    <small class="text-red-500">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="correo_referencia" class="font-semibold">Referencia</label>
                                    <input class="focus:shadow-primary-outline  dark:placeholder:text-white/80  text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-bñue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" type="text" name="referencia" placeholder="Referencia">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                <div>
                                    <input type="hidden" name="subtotal" value="0">
                                </div>
                                <div>
                                    <input type="hidden" name="impuestos" value="0">
                                </div>
                                <div>
                                    <input type="hidden" name="total" value="0">
                                </div>

                                <div class="mb-4">
                                    
                                    <button id="realizar-venta-btn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                                        Cotizar Productos
                                    </button>
                                </div>

                            </div>
                            
                        </form>


                    </div>
        </div>
        <div class="col-span-1 md:col-span-1"></div>
    </div>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var imagesBasePath = '{{ asset('uploads') }}';
    $(document).ready(function() {
        $.ajax({
            url: '{{ route('cotizaciones.cart') }}',
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
                url: '{{ route('cotizaciones.filtro') }}',
                type: 'GET',
                data: $(this).serialize(),
                success: function(response) {
                    // Actualiza los productos en la vista
                    updateProducts(response.productos);
                },
                error: function() {
                   console.log('muchos errores');
                }
            });
        });

        $('.btn-agregar').on('click', function() {
            var productoId = $(this).data('producto-id');
            $.ajax({
                url: '{{ route('cotizaciones.agregar') }}',
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
                url: '{{ route('cotizaciones.eliminar') }}',
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
        console.log(productos);
        // Contenedor para los productos
        var productosContainer = $('#productosContainer');
        productosContainer.empty();
        // Agrega un nuevo div para cada producto
        productos.forEach(function(producto) {
            var productoDiv = `
            <div class="bg-blue-500/13 text-white font-bold py-2 px-8 rounded-lg product-tag product-item flex flex-col items-center">
                                ` + '<img src="' + '{{ asset('uploads') }}' + '/' + producto.imagen + `" alt="`+ producto.nombre+ `" class="w-full h-40 object-cover rounded-md mb-4">
                                <h3 class="text-xl font-semibold uppercase">`+ producto.nombre+ `</h3>
                                <p class="text-gray-600"><span class="font-bold">Precio:</span> $`+ producto.precio_venta+ `</p>
                                <p class="text-gray-600"><span class="font-bold">Stock:</span> `+ producto.unidades_disponibles+ `</p>
                                <button data-producto-id="`+ producto.producto_id+ `" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg btn-agregar">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
            `;
            productosContainer.append(productoDiv);
        });

        // Reasignar el evento click a los botones de agregar luego de haber actualizado los productos
        $('.btn-agregar').on('click', function() {
            var productoId = $(this).data('producto-id');

            $.ajax({
                url: '{{ route('cotizaciones.agregar') }}',
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
            var productoDiv = '<tr>'
                + '<td class="flex items-center">' 
                        + '<img src="{{ asset('uploads') }}/' + producto.imagen + '" alt="' + producto.nombre + '" class="w-16 h-16 object-cover rounded-md mr-2">'
                        + '<span class="uppercase">' + producto.nombre + '</span>'
                    + ' </td>'
                + '<td>' + producto.precio  + ' </td>'
                + '<td>' + producto.cantidad  + ' </td>'
                + '<td>' + productoTotal + ' </td>'
                + '<td> <button data-producto-id="' + producto.producto_id + '" class="btn-eliminar bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg" ><i class="fas fa-trash-alt"> </i></button>' + ' </td>'
            + '</tr>';

            carritoContainer.append(productoDiv);
            subtotal += productoTotal;
        });

        // Calcular impuestos y total
        var impuestos = subtotal * 0.16;
        var total = subtotal;
        subtotal = subtotal - impuestos;

        // Actualizar subtotal, impuestos y total en el div correspondiente
        var totalesDiv = $('#totalDiv');
        totalesDiv.empty();

        totalesDiv.append(`<div class="grid grid-cols-3 gap-4">         <div>
            <p class="font-bold">Pago Neto:</p>
            <p><span id="pago-neto">$` + subtotal +`</span></p>
        </div>
        <div>
            <p class="font-bold">IVA:</p>
            <p><span id="iva">$` + impuestos +`</span></p>
        </div>
        <div>
            <p class="font-bold">Total:</p>
            <p><span id="total">$` + total +`</span></p>
        </div>
    </div>`)
        // Actualizar subtotal, impuestos y total en los campos ocultos
        $('input[name="subtotal"]').val(subtotal.toFixed(2));
        $('input[name="impuestos"]').val(impuestos.toFixed(2));
        $('input[name="total"]').val(total.toFixed(2));
    }
</script>
@endsection
