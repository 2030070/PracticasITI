@extends('layouts.app')

@section('titulo')
   Editar Cotizacion
@endsection

@section('contenido')
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    <div class="col-span-1 md:col-span-2">
      <div class="">
        <form action="{{ route('cotizaciones.update', $cotizacion->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="producto_id" class="block mb-2 font-semibold">Producto:</label>
              <select name="producto_id" id="producto_id" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione un producto">
                <option value="">Seleccione un producto</option>
                @foreach ($productos as $producto)
                  <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_compra }}" @if($producto->id == $cotizacion->producto_id) selected @endif>{{ $producto->nombre }}</option>
                @endforeach
              </select>
            </div>

            <div class="w-1/2 ml-2">
              <label for="referencia" class="block mb-2 font-semibold">Referencia:</label>
              <input type="text" name="referencia" id="referencia" value="{{ $cotizacion->referencia }}" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Referencia">
            </div>
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="cliente_id" class="block mb-2 font-semibold">Cliente:</label>
              <select name="cliente_id" id="cliente_id" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione un cliente">
                <option value="">Seleccione un cliente:</option>
                @foreach ($clientes as $cliente)
                  <option value="{{ $cliente->id }}" @if($cliente->id == $cotizacion->cliente_id) selected @endif>{{ $cliente->nombre }}</option>
                @endforeach
              </select>
            </div>

            <div class="w-1/2 ml-2">
              <label for="estatus" class="block mb-2 font-semibold">Estatus:</label>
              <select name="estatus" id="estatus" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estatus">
                <option value="">Seleccione el estatus</option>
                <option value="enviada" @if($cotizacion->estatus == 'enviada') selected @endif>Enviada</option>
                <option value="pendiente" @if($cotizacion->estatus == 'pendiente') selected @endif>Pendiente</option>
              </select>
            </div>
          </div>

          <input type="hidden" id="total_producto" name="total_producto" value="{{ $cotizacion->total }}">

          <div >
            <!-- Botón para agregar producto -->
            <button type="button" id="agregar_producto" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">Agregar Producto</button>
          </div>

          <!-- Campo para el total -->
          <div class="mb-4">
            <label for="total" class="block mb-2 font-semibold">Total:</label>
            <input
              type="number"
              name="total"
              id="total"
              value="{{ $cotizacion->total }}"
              class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
              placeholder="Total $$"
              step="0.01"
              min="0"
              readonly
            />
          </div>

          <div class="mb-4 flex"></div>

          <!-- Tabla de productos agregados -->
          <div class="overflow-x-auto">
            <table id="productos_agregados" class="min-w-full border-2 border-blue-500 rounded-lg">
              <thead>
                <tr>
                  <th class="py-2 px-4 border-b text-left">Producto</th>
                  <th class="py-2 px-4 border-b text-left">Precio</th>
                  <th class="py-2 px-4 border-b text-left">Cantidad</th>
                  <th class="py-2 px-4 border-b text-left">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <!-- Filas de productos agregados aquí -->
              </tbody>
            </table>
          </div>

          <div class="overflow-x-auto mt-6">
            <table id="calculos" class="min-w-full border-2 border-green-500 rounded-lg">
              <thead>
                <tr>
                  <th class="py-2 px-4 border-b text-left">Descripción</th>
                  <th class="py-2 px-4 border-b text-left">Monto</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Subtotal</td>
                  <td id="subtotal"></td>
                </tr>
                <tr>
                  <td>IVA (16%)</td>
                  <td id="iva"></td>
                </tr>
                <tr>
                  <td>Total con IVA</td>
                  <td id="total_con_iva"></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Botón de actualización -->
          <div >
            <input type="submit" value="Actualizar" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
          </div>
        </form>
      </div>
    </div>
    <div class="col-span-1 md:col-span-1">
      <div class="sticky top-0 h-screen p-4 rounded-lg">
        <div class="flex flex-col items-center gap-4 bg-blue-500/13 rounded-lg p-4">
          <a href="{{ route('cotizaciones.show') }}">
            <img src="{{ asset('img/cotizacion.png') }}" alt="Imagen" class="w-48 h-48 rounded-sm">
            <h3 class="text-blue-700">Ver Cotizaciones</h3>
          </a> 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const agregarProductoBtn = document.getElementById('agregar_producto');
    const productoSelect = document.getElementById('producto_id');
    const precioProductoInput = document.getElementById('total_producto');
    const productosAgregados = document.getElementById('productos_agregados').getElementsByTagName('tbody')[0];
    const totalInput = document.getElementById('total');
    const subtotalDisplay = document.getElementById('subtotal');
    const ivaDisplay = document.getElementById('iva');
    const totalConIvaDisplay = document.getElementById('total_con_iva');
    const calculosTable = document.getElementById('calculos');

    agregarProductoBtn.addEventListener('click', function () {
      const selectedProduct = productoSelect.options[productoSelect.selectedIndex];

      if (selectedProduct.value === "") {
        alert('Seleccione un producto.');
        return;
      }

      const precio = parseFloat(selectedProduct.getAttribute('data-precio'));

      // Check if the product already exists in the table
      const existingRow = findExistingProductRow(selectedProduct.value);

      if (existingRow) {
        // If the product exists, increase the quantity
        const cantidadInput = existingRow.querySelector('td:nth-child(3) input');
        const currentQuantity = parseInt(cantidadInput.value);
        cantidadInput.value = currentQuantity + 1;
      } else {
        // If the product doesn't exist, add a new row
        agregarProducto(selectedProduct.text, precio);
      }

      // Calcular y actualizar el total
      calcularTotal();
      actualizarCalculos();

    });

    function findExistingProductRow(productId) {
      const rows = productosAgregados.getElementsByTagName('tr');
      for (const row of rows) {
        const productIdCell = row.querySelector('td:nth-child(1)');
        if (productIdCell.textContent === productId) {
          return row;
        }
      }
      return null;
    }
    
    function agregarProducto(nombre, precio) {
      // Buscar la fila existente para el producto
      const existingRow = findExistingProductRow(nombre);

      if (existingRow) {
        // Si el producto ya existe, aumentar la cantidad
        const cantidadInput = existingRow.querySelector('td:nth-child(3) input');
        const currentQuantity = parseInt(cantidadInput.value);
        cantidadInput.value = currentQuantity + 1;
      } else {
        // Si el producto no existe, agregar una nueva fila
        const cantidadInput = document.createElement('input');
        cantidadInput.type = 'number';
        cantidadInput.min = '1';
        cantidadInput.value = '1';

        const newRow = productosAgregados.insertRow();
        newRow.innerHTML = `
          <td>${nombre}</td>
          <td>${precio.toFixed(2)}</td>
          <td></td>
          <td>
            <button type="button" class="eliminar_producto">Eliminar</button>
          </td>
        `;

        newRow.cells[2].appendChild(cantidadInput);

        // Manejar la eliminación del producto
        const eliminarBtn = newRow.querySelector('.eliminar_producto');
        eliminarBtn.addEventListener('click', function () {
          productosAgregados.removeChild(newRow);
          calcularTotal();
        });

        precioProductoInput.value = parseFloat(precioProductoInput.value) + precio; // Acumular el precio
      }

      // Calcular y actualizar el total
      calcularTotal();
    }

    
    function calcularTotal() {
      let subtotal = 0;
      const rows = productosAgregados.getElementsByTagName('tr');
      for (const row of rows) {
        const precioCell = row.querySelector('td:nth-child(2)');
        const cantidadInput = row.querySelector('td:nth-child(3) input');
        const cantidad = parseInt(cantidadInput.value);
        subtotal += parseFloat(precioCell.textContent) * cantidad;
      }

      const iva = subtotal * 0.16; // Calcular el IVA (16%)
      const totalConIva = subtotal - iva; // Restar el IVA al subtotal

      subtotalDisplay.textContent = totalConIva.toFixed(2);
      ivaDisplay.textContent = iva.toFixed(2);
      totalConIvaDisplay.textContent = subtotal.toFixed(2);

      // Actualizar el valor del campo total_producto
      totalInput.value = subtotal.toFixed(2); // Mostrar el subtotal en el campo total
      precioProductoInput.value = totalConIva.toFixed(2);
    }

    document.querySelector('form').addEventListener('submit', function (e) {
      // Calculate and set the total before submitting the form
      calcularTotal();
    });
  });
</script>
@endpush