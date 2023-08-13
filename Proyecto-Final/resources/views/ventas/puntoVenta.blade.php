<!-- resources/views/productos/index.blade.php -->
@extends('layouts.app')

@section('titulo')
    Punto de venta
@endsection

@section('contenido')
    <div class="container mx-auto p-4">
        <!-- Barra superior -->
        <div class="flex justify-between mb-4">
            <div>
                <select class="border p-3 w-full rounded-lg">
                    <option selected disabled>Productos</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select class="border p-3 w-full rounded-lg">
                    <option selected disabled>Categorias</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="text" class="border border-gray-300 rounded px-4 py-2" placeholder="Buscar productos...">
                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Buscar</button>
            </div>
        </div>

        <!-- Contenido principal -->
        <div class="flex">
           <!-- Lista de productos -->
            <div class="w-2/3">
                <h2 class="text-2xl mb-4">Lista de productos</h2>
                <div class="space-y-4">
                    @foreach ($productos as $producto)
                        <button id="btn-producto-{{ $producto->id }}" class="px-4 py-2 rounded btn-producto" data-producto-id="{{ $producto->id }}">
                            <img src="{{ asset('uploads/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-16 h-16 object-cover">
                            <span class="text-gray-800">{{ $producto->nombre }}</span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Productos seleccionados -->
            <div class="w-1/3">
                <h2 class="text-2xl mb-4">Productos seleccionados</h2>
                <div>
                    <ul class="border border-gray-300 rounded p-4" id="productosSeleccionados">
                        <!-- La lista de productos seleccionados estará vacía inicialmente -->
                    </ul>
                    <p class="mt-4 font-bold" id="total">Total: $0.00</p>
                    <!-- Botón "Realizar compra" -->
                    <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" id="btn-realizar-compra" disabled>Realizar compra</button>
                    <!-- Botón "Realizar cotización" -->
                    <button class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded" id="btn-realizar-cotizacion">Realizar cotización</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de compra -->
    <div id="modal-compra" class="fixed inset-0 items-center justify-center z-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold mb-4">Realizar compra</h3>
            <div id="modal-productos-seleccionados" class="mb-4">
                <!-- La lista de productos seleccionados en el modal estará vacía inicialmente -->
            </div>
            <p id="modal-total" class="font-bold mb-4">Total: $0.00</p>
            <form id="form-compra" action="{{ route('guardar.compra') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block">Estado de la venta:</label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="estado_venta" value="completada" checked>
                        <span class="ml-2">Completada</span>
                    </label>
                    <!-- Campo oculto para enviar el total -->
                    <input type="hidden" id="modal-total-input" name="total_venta">
                    <!-- Campo oculto para enviar los productos seleccionados -->
                    <input type="hidden" name="productos_seleccionados" id="productos_seleccionados_input">
                </div>
                <div class="mb-4">
                    <label class="block">Pago:</label>
                    <input type="text" id="modal-pago" name="pago_venta" class="border p-3 w-full rounded-lg" placeholder="Cantidad a pagar">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded mr-2" id="btn-cancelar-compra">Cancelar</button>
                    <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded" id="btn-guardar-compra">Guardar compra</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de cotización -->
    <div id="modal-cotizacion" class="fixed inset-0  items-center justify-center z-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold mb-4">Realizar cotización</h3>
            <div id="modal-productos-seleccionados-cotizacion" class="mb-4">
                <!-- La lista de productos seleccionados en el modal estará vacía inicialmente -->
            </div>
            <p id="modal-total-cotizacion" class="font-bold mb-4">Total: $0.00</p>
            <form>
                <div class="mb-4">
                    <label class="block">Estado de la cotización:</label>
                    <label class="inline-flex items-center">
                        <input type="radio" class="form-radio" name="estado_cotizacion" value="pendiente">
                        <span class="ml-2">Pendiente</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="radio" class="form-radio" name="estado_cotizacion" value="aprobada">
                        <span class="ml-2">Aprobada</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="radio" class="form-radio" name="estado_cotizacion" value="rechazada">
                        <span class="ml-2">Rechazada</span>
                    </label>
                </div>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Guardar cotización</button>
            </form>
        </div>
    </div>



    <script>
        //Obtener elementos del DOM
        const btnProductos = document.querySelectorAll('.btn-producto');
        const productosSeleccionados = document.getElementById('productosSeleccionados');
        const total = document.getElementById('total');
        let productosSeleccionadosList = [];
        let totalPrecio = 0;


        function renderProductosSeleccionados() {
            productosSeleccionados.innerHTML = '';
            total.textContent = `Total: $${totalPrecio.toFixed(2)}`;

            productosSeleccionadosList.forEach(producto => {
                const li = document.createElement('li');
                li.textContent = `${producto.nombre} - Precio: $${producto.precio_venta} - Cantidad: ${producto.cantidad}`;

                const deleteBtn = document.createElement('button');
                deleteBtn.textContent = 'Eliminar';
                deleteBtn.classList.add('ml-2', 'text-red-600');
                deleteBtn.addEventListener('click', () => {
                    eliminarProducto(producto.id);
                });

                li.appendChild(deleteBtn);
                productosSeleccionados.appendChild(li);
            });

            // Habilitar o deshabilitar el botón "Realizar compra" según si hay productos seleccionados
            const btnRealizarCompra = document.getElementById('btn-realizar-compra');
            btnRealizarCompra.disabled = productosSeleccionadosList.length === 0;
        }

        // Restar cantidad de productos seleccionados o eliminar si solo hay uno
        function eliminarProducto(productoId) {
            const productoIndex = productosSeleccionadosList.findIndex(item => item.id === productoId);
            if (productoIndex !== -1) {
                const producto = productosSeleccionadosList[productoIndex];
                if (producto.cantidad > 1) {
                    producto.cantidad--;
                    totalPrecio -= parseFloat(producto.precio_venta);
                } else {
                    totalPrecio -= parseFloat(producto.precio_venta);
                    productosSeleccionadosList.splice(productoIndex, 1);
                }
                renderProductosSeleccionados();
            }
        }

        btnProductos.forEach(btn => {
            btn.addEventListener('click', () => {
                const productoId = btn.getAttribute('data-producto-id');
                console.log('Producto seleccionado:', productoId); // Agregar mensaje de depuración

                const producto = getProductById(productoId);

                // Verificar si el producto ya está en la lista
                const productoExistente = productosSeleccionadosList.find(item => item.id === producto.id);

                if (productoExistente) {
                    // Si el producto ya está en la lista, solo aumentamos la cantidad
                    if (productoExistente.cantidad + 1 <= producto.unidades_disponible) {
                        productoExistente.cantidad++;
                        totalPrecio += parseFloat(producto.precio_venta);
                    } else {
                        alert(`¡No se puede agregar más del producto "${producto.nombre}"!\nUnidades disponibles: ${producto.unidades_disponible}`);
                    }
                } else {
                    // Si el producto no está en la lista, lo agregamos con cantidad 1
                    producto.cantidad = 1;
                    productosSeleccionadosList.push(producto);
                    totalPrecio += parseFloat(producto.precio_venta);
                }

                renderProductosSeleccionados();
            });
        });


        function getProductById(id) {
            return @json($productos->keyBy('id'))[id];
        }

        // Función para actualizar la lista de productos y el total en el modal
        function modalProductos() {
            const modalProductosSeleccionados = document.getElementById('modal-productos-seleccionados');
            const modalTotal = document.getElementById('modal-total');
            const modalTotalInput = document.getElementById('modal-total-input'); // Campo oculto para el total
            const modalPago = document.getElementById('modal-pago');


            modalProductosSeleccionados.innerHTML = '';
            modalTotal.textContent = `Total: $${totalPrecio.toFixed(2)}`;
            modalTotalInput.value = totalPrecio.toFixed(2); // Asignar el total al campo oculto

            productosSeleccionadosList.forEach(producto => {
                const p = document.createElement('p');
                p.textContent = `${producto.nombre} - Precio: $${producto.precio_venta} - Cantidad: ${producto.cantidad}`;
                modalProductosSeleccionados.appendChild(p);
            });

            modalPago.value = ''; // Limpiar el valor del campo de pago
        }

        // Abrir modal de compra al hacer clic en "Realizar compra"
        const btnRealizarCompra = document.getElementById('btn-realizar-compra');
        const modalCompra = document.getElementById('modal-compra');

        btnRealizarCompra.addEventListener('click', () => {
            // Antes de abrir el modal, actualizamos los detalles de los productos seleccionados y el total
            modalProductos();
            modalCompra.classList.remove('hidden');
        });

        //Mandar los datos del formulario
        const btnGuardarCompra = document.getElementById('btn-guardar-compra');
        const formCompra = document.getElementById('form-compra');
        const modalPago = document.getElementById('modal-pago');
        const modalTotalInput = document.getElementById('modal-total-input');
        const productosSeleccionadosInput = document.getElementById('productos_seleccionados_input');

        btnGuardarCompra.addEventListener('click', () => {
            // Actualizar el valor del campo oculto 'productos_seleccionados_input' con los productos seleccionados
            const productosSeleccionadosInput = document.getElementById('productos_seleccionados_input');
            productosSeleccionadosInput.value = JSON.stringify(productosSeleccionadosList);

            // Obtener el valor del campo "pago_venta"
            const pagoVenta = parseFloat(modalPago.value);
            // Obtener el total de la venta
            const totalVenta = totalPrecio.toFixed(2);
            // Asignar el total al campo oculto
            modalTotalInput.value = totalVenta;
            if (pagoVenta >= totalVenta) {
                // Enviar el formulario al controlador
                formCompra.submit();
            }else{
                alert('Por favor, ingrese una cantidad válida para el pago.');
                return;
            }
        });

        // Función para cerrar el modal de compra al hacer clic en "Cancelar"
        const btnCancelarCompra = document.getElementById('btn-cancelar-compra');

        btnCancelarCompra.addEventListener('click', () => {
            modalCompra.classList.add('hidden');
        });



        // Función para actualizar la lista de productos y el total en el modal de cotización
        function modalProductosCotizacion() {
            const modalProductosSeleccionadosCotizacion = document.getElementById('modal-productos-seleccionados-cotizacion');
            const modalTotalCotizacion = document.getElementById('modal-total-cotizacion');
            const modalPagoCotizacion = document.getElementById('modal-pago-cotizacion');

            modalProductosSeleccionadosCotizacion.innerHTML = '';
            modalTotalCotizacion.textContent = `Total: $${totalPrecio.toFixed(2)}`;

            productosSeleccionadosList.forEach(producto => {
                const p = document.createElement('p');
                p.textContent = `${producto.nombre} - Precio: $${producto.precio_venta} - Cantidad: ${producto.cantidad}`;
                modalProductosSeleccionadosCotizacion.appendChild(p);
            });

            modalPagoCotizacion.value = ''; // Limpiar el valor del campo de pago
        }

        // Abrir modal de cotización al hacer clic en "Realizar cotización"
        const btnRealizarCotizacion = document.getElementById('btn-realizar-cotizacion');
        const modalCotizacion = document.getElementById('modal-cotizacion');

        btnRealizarCotizacion.addEventListener('click', () => {
            // Antes de abrir el modal, actualizamos los detalles de los productos seleccionados y el total
            modalProductosCotizacion();
            modalCotizacion.classList.remove('hidden');
        });
    </script>
@endsection
