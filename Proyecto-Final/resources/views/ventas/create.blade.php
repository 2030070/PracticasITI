@extends('layouts.app')

@section('titulo')
   Punto de Venta
@endsection

@push('styles')
    <style>
        /* Estilo para la transición al pasar el mouse por las etiquetas */
        .product-tag:hover {
            transform: scale(1.05); /* Aumenta el tamaño al 110% */
            transition: transform 0.3s ease; /* Duración de la transición */
        }

        /* Estilo para reducir el tamaño de las etiquetas de los productos */
        .product-item {
            font-size: 14px;
        }
    </style>
@endpush

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-2 md:col-span-3 md:flex-wrap"> <!-- Agregar la clase md:flex-wrap -->

            <!-- Botones para filtrar por categoría -->
            <div class="grid grid-cols-4 gap-4 py-8">
                <a href="{{ route('ventas.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Todas</a>
                @foreach ($categorias as $categoria)
                    <a href="{{ route('ventas.create', ['categoria_id' => $categoria->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">{{ $categoria->nombre }}</a>
                @endforeach
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @php
                    $categoriaSeleccionadaId = request('categoria_id');
                    $productosCategoria = $categoriaSeleccionadaId ? $productos->where('categoria_id', $categoriaSeleccionadaId) : $productos;
                @endphp

                @if ($productosCategoria->isEmpty())
                    <div class="text-center text-red-500 py-8">
                        @if ($categoriaSeleccionadaId)
                            No existen productos para esta categoría.
                        @else
                            No hay productos para mostrar.
                        @endif
                    </div>
                @else
                    @foreach ($productosCategoria as $producto)
                        <div class="bg-blue-500/13 text-white font-bold py-2 px-8 rounded-lg product-tag product-item flex flex-col items-center">
                            <img src="{{ asset('uploads/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-48 object-cover rounded-md mb-4">
                            <h3 class="text-xl font-semibold uppercase">{{ $producto->nombre }}</h3>
                            <p class="text-gray-600"><span class="font-bold">Precio de Venta:</span> ${{ $producto->precio_venta }}</p>
                            <p class="text-gray-600"><span class="font-bold">Unidades Disponibles:</span> {{ $producto->unidades_disponibles }}</p>
                            <p class="text-gray-600"><span class="font-bold">Categoría:</span> {{ $producto->categoria->nombre }}</p>
                            {{-- <p class="text-gray-600">Subcategoría: {{ $producto->subcategoria->nombre }}</p> --}}
                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg add-product-btn"
                                    data-product="{{ $producto }}"
                                    data-price="{{ $producto->precio_venta }}"
                                    data-imagen="{{ asset('uploads/' . $producto->imagen) }}">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="container mx-auto px-4 mt-4 bg-blue-500/13 rounded-lg shadow-lg overflow-hidden" id="carrito-container" style="display: none;">
                <h2 class="text-lg font-semibold mb-2">Carrito de Compras</h2>
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
                    <tbody id="carrito-body">
                        <!-- Aquí se agregarán las filas de productos del carrito -->
                    </tbody>
                </table>
                <!-- Cálculo de total final, IVA y pago neto -->
                <div class="font-bold text-center">Resumen de la compra</div>
                <div class="flex justify-center px-4 py-2">
                    <div class="text-gray-600">
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <p class="font-bold">Pago Neto:</p>
                                <p><span id="pago-neto">$0.00</span></p>
                            </div>
                            <div>
                                <p class="font-bold">IVA:</p>
                                <p><span id="iva">$0.00</span></p>
                            </div>
                            <div>
                                <p class="font-bold">Total:</p>
                                <p><span id="total">$0.00</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center px-4 py-2">
                    <button id="realizar-venta-btn" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg">
                        Realizar Venta
                    </button>
                </div>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1"></div>
    </div>
</div>

<!-- Include the external JavaScript file -->
<script src="{{ asset('js/shopping_cart.js') }}"></script> <!-- Replace 'js/shopping_cart.js' with the actual path to your JavaScript file -->

@endsection

@push('scripts')
<script>
    // Cuando se carga el DOM, se ejecuta la siguiente función.
    document.addEventListener('DOMContentLoaded', function () {
        const cart = []; // Array para almacenar los productos en el carrito.
        const vatRate = 0.16; // Suponiendo una tasa de IVA del 16%.

        // Función para actualizar la interfaz del carrito.
        function updateCartUI() {
            const cartBody = document.getElementById('carrito-body');
            cartBody.innerHTML = ''; // Borra el contenido anterior.

            let cartTotal = 0;

            // Itera a través de los productos en el carrito.
            cart.forEach((product) => {
                const productSubtotal = product.precio_venta * product.quantity;
                cartTotal += productSubtotal;

                // Crea una fila en la tabla para cada producto en el carrito.
                const row = document.createElement('tr');

                // Crea una celda para el nombre del producto con estilo centrado.
                const productNameCell = document.createElement('td');
                productNameCell.classList.add('text-center'); // Agrega la clase 'text-center' para centrar horizontalmente.
                productNameCell.style.display = 'flex';
                productNameCell.style.flexDirection = 'column';
                productNameCell.style.alignItems = 'center'; // Centra los elementos horizontalmente.
                productNameCell.style.gap = '8px'; // Ajusta el espacio entre la imagen y el texto si es necesario.

                // Crea un elemento de imagen para la imagen del producto.
                const productImage = document.createElement('img');
                productImage.src = "{{ asset('uploads/') }}" + '/' + product.imagen; // Usa la función asset() para generar la URL completa.
                productImage.alt = product.nombre;
                productImage.className = 'w-12 h-12 object-cover rounded-md'; // Ajusta el ancho, alto y otros estilos según sea necesario.

                // Agrega la imagen del producto a productNameCell.
                productNameCell.appendChild(productImage);

                // Agrega el nombre del producto a productNameCell.
                const productName = document.createElement('span');
                productName.textContent = product.nombre;
                productNameCell.appendChild(productName);

                // Crea celdas para el precio, cantidad y subtotal del producto.
                const productPriceCell = document.createElement('td');
                productPriceCell.textContent = '$' + product.precio_venta;

                const productQuantityCell = document.createElement('td');
                productQuantityCell.textContent = product.quantity;

                const productSubtotalCell = document.createElement('td');
                productSubtotalCell.textContent = '$' + productSubtotal;

                // Crea una celda para el botón "Eliminar" del producto.
                const removeBtnCell = document.createElement('td');
                const removeBtn = document.createElement('button');
                removeBtn.className = 'bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg remove-product-btn';
                removeBtn.dataset.product = JSON.stringify(product); // Almacena el objeto de producto en el dataset.
                const trashIcon = document.createElement('i');
                trashIcon.className = 'fas fa-trash-alt'; // Usa el ícono de basura rojo.
                removeBtn.appendChild(trashIcon);

                // Cuando se hace clic en el botón "Eliminar", se llama a la función para quitar el producto del carrito.
                removeBtn.addEventListener('click', () => removeProductFromCart(product));
                removeBtnCell.appendChild(removeBtn);

                // Agrega todas las celdas a la fila.
                row.appendChild(productNameCell);
                row.appendChild(productPriceCell);
                row.appendChild(productQuantityCell);
                row.appendChild(productSubtotalCell);
                row.appendChild(removeBtnCell);

                // Agrega la fila a la tabla.
                cartBody.appendChild(row);
            });

            // Calcula el total, IVA y pago neto basado en los productos en el carrito y actualiza los elementos correspondientes en la interfaz.
            const total = cartTotal.toFixed(2);
            const vat = (cartTotal * vatRate).toFixed(2);
            const netPayment = (cartTotal - vat).toFixed(2);

            document.getElementById('pago-neto').textContent = '$' + netPayment;
            document.getElementById('iva').textContent = '$' + vat;
            document.getElementById('total').textContent = '$' + total;

            // Muestra u oculta el contenedor del carrito según si hay productos en el carrito o no.
            const cartContainer = document.getElementById('carrito-container');
            cartContainer.style.display = cart.length > 0 ? 'block' : 'none';
        }

        // Función para agregar un producto al carrito.
        function addProductToCart(product) {
            const existingProductIndex = cart.findIndex((item) => item.id === product.id);

            // Si el producto ya está en el carrito, aumenta la cantidad; de lo contrario, agrega el producto al carrito con cantidad 1.
            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity++;
            } else {
                cart.push({ ...product, quantity: 1 });
            }

            // Actualiza la interfaz del carrito.
            updateCartUI();
        }

        // Función para eliminar un producto del carrito.
        function removeProductFromCart(product) {
            const existingProductIndex = cart.findIndex((item) => item.id === product.id);

            // Si el producto está en el carrito, disminuye la cantidad; si la cantidad es menor o igual a 0, elimina el producto del carrito.
            if (existingProductIndex !== -1) {
                cart[existingProductIndex].quantity--;

                if (cart[existingProductIndex].quantity <= 0) {
                    cart.splice(existingProductIndex, 1); // Elimina el producto del carrito.
                }
            }

            // Actualiza la interfaz del carrito.
            updateCartUI();
        }

        // Asigna los manejadores de eventos click a los elementos 'add-product-btn'.
        const addProductButtons = document.querySelectorAll('.add-product-btn');
        addProductButtons.forEach((button) => {
            button.addEventListener('click', function () {
                // Obtiene el objeto de producto desde el atributo 'data-product' y lo agrega al carrito.
                const product = JSON.parse(this.dataset.product);
                addProductToCart(product);
            });
        });

        // Asigna el manejador de eventos click al botón 'realizar-venta-btn'.
        const realizarVentaBtn = document.getElementById('realizar-venta-btn');
        realizarVentaBtn.addEventListener('click', function () {
            // Aquí crearemos un objeto que contendrá los datos que deseamos enviar al servidor.
            const data = {
                fecha: new Date().toISOString(), // Supongamos que la fecha de venta es la fecha actual.
                nombre_cliente: 'Nombre del cliente', // Reemplaza 'Nombre del cliente' con el nombre real del cliente.
                referencia: 'Referencia de venta', // Reemplaza 'Referencia de venta' con la referencia real de la venta.
                estatus: 'En proceso', // Supongamos que el estatus inicial es 'En proceso'.
                pago: parseFloat(document.getElementById('pago-neto').textContent.replace('$', '')), // Obtén el valor del pago neto y conviértelo a un número flotante.
                total: parseFloat(document.getElementById('total').textContent.replace('$', '')), // Obtén el valor total y conviértelo a un número flotante.
                pago_parcial: 0.0, // Supongamos que el pago parcial inicial es 0.0.
                pago_pendiente: parseFloat(document.getElementById('total').textContent.replace('$', '')), // Suponemos que el pago pendiente inicial es igual al total.
                creado_por: 'Nombre del usuario', // Reemplaza 'Nombre del usuario' con el nombre real del usuario que realiza la venta.
                productos: cart // Agregamos el array 'cart' que contiene los productos del carrito.
            };

            // Realizamos la solicitud POST utilizando Axios.
            axios.post('/guardar-venta', data)
                .then(response => {
                    // Si la solicitud es exitosa, limpiamos el carrito y actualizamos la interfaz.
                    cart = [];
                    updateCartUI();
                    alert('¡Compra completada!');
                })
                .catch(error => {
                    // Si ocurre algún error, puedes manejarlo aquí.
                    console.error(error);
                });
        });


    });
</script>

@endpush
