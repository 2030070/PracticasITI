<!-- resources/views/punto_de_venta/index.blade.php -->

@extends('layouts.app')

@section('titulo')
   Punto de Venta
@endsection

@push('styles')
<style>
    /* Estilo para la transición al pasar el mouse por las etiquetas */
    .product-tag:hover {
        transform: scale(1.1); /* Aumenta el tamaño al 110% */
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
                <a href="{{ route('punto_de_venta.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Todas</a>
                @foreach ($categorias as $categoria)
                    <a href="{{ route('punto_de_venta.index', ['categoria_id' => $categoria->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">{{ $categoria->nombre }}</a>
                @endforeach
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($productos as $producto)
                    <div class="bg-blue-500/13 text-white font-bold py-2 px-8 rounded-lg product-tag product-item flex flex-col items-center">
                        {{-- <img src="{{ asset('ruta/de/las/imagenes/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-48 object-cover mb-4"> --}}
                        <h3 class="text-lg font-semibold">{{ $producto->nombre }}</h3>
                        <p class="text-gray-600">Precio de Venta: ${{ $producto->precio_venta }}</p>
                        <p class="text-gray-600">Unidades Disponibles: {{ $producto->unidades_disponibles }}</p>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg add-product-btn" data-product="{{ $producto }}" data-price="{{ $producto->precio_venta }}"><i class="fas fa-cart-plus"></i></button>
                    </div>
                @endforeach
            </div>
            <div class="container mx-auto px-4 mt-4 bg-blue-500/13 rounded-lg product-tag product-item flex flex-col items-center" id="carrito-container" style="display: none;">
                <h2 class="text-lg font-semibold mb-2">Carrito de Compras</h2>
                <table class="w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Producto</th>
                            <th class="px-4 py-2">Precio</th>
                            <th class="px-4 py-2">Cantidad</th>
                            <th class="px-4 py-2">Subtotal</th>
                            <th class="px-4 py-2"></th> <!-- Add the Actions column -->
                        </tr>
                    </thead>
                    <tbody id="carrito-body">
                        <!-- Aquí se agregarán las filas de productos -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-span-1 md:col-span-1"></div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const carritoBody = document.getElementById("carrito-body");
    const carritoContainer = document.getElementById("carrito-container");

    // Evento para agregar el producto al carrito
    const addProductBtns = document.getElementsByClassName("add-product-btn");
    for (const addProductBtn of addProductBtns) {
        addProductBtn.addEventListener("click", function() {
            const product = JSON.parse(this.dataset.product);
            const price = parseFloat(this.dataset.price);

            // Buscar si el producto ya existe en el carrito
            let existingRow = null;
            for (const row of carritoBody.children) {
                if (row.dataset.productId === product.id) {
                    existingRow = row;
                    break;
                }
            }

            if (existingRow) {
                // Si el producto ya existe, aumentar la cantidad y actualizar el subtotal
                const quantityInput = existingRow.querySelector(".quantity-input");
                const currentQuantity = parseInt(quantityInput.value);
                const newQuantity = currentQuantity + 1;
                quantityInput.value = newQuantity;
                const subtotalCell = existingRow.querySelector(".subtotal");
                const subtotal = newQuantity * price;
                subtotalCell.innerText = "$" + subtotal.toFixed(2);
            } else {
                // Si el producto no existe, agregar una nueva fila al carrito
                const row = document.createElement("tr");
                row.dataset.productId = product.id;
                row.innerHTML = `
                    <td class="px-4 py-2">${product.nombre}</td>
                    <td class="px-4 py-2">$${price.toFixed(2)}</td>
                    <td class="px-4 py-2">
                        <input type="number" min="1" step="1" value="1" class="quantity-input bg-blue-500/13">
                    </td>
                    <td class="px-4 py-2 subtotal">$${price.toFixed(2)}</td>
                `;

                carritoBody.appendChild(row);

                const removeButton = document.createElement("button");
                removeButton.innerHTML = "<i class='fas fa-trash-alt'></i>";
                removeButton.classList.add("remove-product-btn", "bg-red-500", "hover:bg-red-700", "text-white", "font-bold", "py-1", "px-2", "rounded");
                row.appendChild(removeButton);

                // Add the click event to remove the product
                removeButton.addEventListener("click", function() {
                    row.remove(); // Remove the row from the cart
                    updateTotal(); // Update the total after removing the product
                });
            }

            updateTotal();
            carritoContainer.style.display = "block"; // Show the cart section
        });
    }

    // Evento para actualizar el subtotal al cambiar la cantidad
    carritoBody.addEventListener("input", function(event) {
        if (event.target.classList.contains("quantity-input")) {
            const quantity = parseInt(event.target.value);
            const price = parseFloat(event.target.parentElement.previousElementSibling.innerText.replace("$", ""));
            const subtotalCell = event.target.parentElement.nextElementSibling;

            const subtotal = quantity * price;
            subtotalCell.innerText = "$" + subtotal.toFixed(2);

            updateTotal();
        }
    });

    // Función para actualizar el total del carrito
    function updateTotal() {
        const subtotals = document.getElementsByClassName("subtotal");
        let total = 0;
        for (const subtotal of subtotals) {
            total += parseFloat(subtotal.innerText.replace("$", ""));
        }

        const totalCell = document.createElement("tr");
        totalCell.innerHTML = `
            <td class="px-4 py-2" colspan="3"><strong>Total</strong></td>
            <td class="px-4 py-2">$${total.toFixed(2)}</td>
        `;

        const existingTotal = document.getElementById("total");
        if (existingTotal) {
            carritoBody.removeChild(existingTotal);
        }
        totalCell.id = "total";
        carritoBody.appendChild(totalCell);
    }
});

</script>
@endpush
