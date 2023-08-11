@extends('layouts.app')

@section('titulo')
   Crear Compra
@endsection

@section('contenido')
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    <div class="col-span-1 md:col-span-2">
      <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      
        <form action="{{ route('compras.store') }}" method="POST">
          @csrf

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="referencia" class="block mb-2 font-semibold">Referencia:</label>
              <input type="text" name="referencia" id="referencia" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Ingrese la referencia" value="{{ old('referencia') }}">
              @error('referencia')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div> 

            <div class="w-1/2 ml-2">
              <label for="nombre_proveedor" class="block mb-2 font-semibold">Nombre de Proveedor:</label>
              <select name="nombre_proveedor" id="nombre_proveedor" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                <option value="">Seleccione el nombre del proveedor</option>
                @foreach($proveedores as $proveedor)
                  <option value="{{ $proveedor->nombre }}" {{ old('nombre_proveedor') == $proveedor->nombre ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                @endforeach
              </select>
              @error('nombre_proveedor')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="estatus" class="block mb-2 font-semibold">Estatus de Compra:</label>
              <select name="estatus" id="estatus" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estatus de la compra">
                <option value="">Seleccione el estatus</option>
                <option value="en_proceso" {{ old('estatus') == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="completada" {{ old('estatus') == 'completada' ? 'selected' : '' }}>Completada</option>
                <option value="cancelada" {{ old('estatus') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
              </select>
              @error('estatus')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div class="w-1/2 ml-2">
              <label for="fecha" class="block mb-2 font-semibold">Fecha:</label>
              <input type="date" name="fecha" id="fecha" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-auto appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" value="{{ old('fecha') }}">
              @error('fecha')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>        
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="pagado" class="block mb-2 font-semibold">Pagado:</label>
              <input type="number" name="pagado" id="pagado" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el pagado" value="{{ old('pagado') }}">
              @error('pagado')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div class="w-1/2 ml-2">
              <label for="pendiente_de_pago" class="block mb-2 font-semibold">Pendiente de Pago:</label>
              <input type="number" name="pendiente_de_pago" id="pendiente_de_pago" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el pendiente de pago" value="{{ old('pendiente_de_pago') }}">
              @error('pendiente_de_pago')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>        
          </div>

          <input type="hidden" id="nombre_producto" name="nombre_producto" value="{{ old('nombre_producto') }}">


          <div class="mb-4">
            <div class="mb-4 flex">
              <div class="w-1/2 mr-2">
                <label for="producto_id" class="block mb-2 font-semibold">Agregar Producto:</label>
                <select name="producto_id" id="producto_id" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                  <option value="">Seleccione un producto</option>
                  @foreach($productos as $producto)
                  <option value="{{ $producto->id }}" data-precio-compra="{{ $producto->precio_compra }}">{{ $producto->nombre }}</option>
                  @endforeach
                </select>
                @error('producto_id')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
              
              <div class="w-1/2 ml-2">
                <label for="cantidad_producto" class="block mb-2 font-semibold">Cantidad de Productos:</label>
                <input type="number" id="cantidad_producto" name="cantidad_producto" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" min="1" placeholder="Cantidad">
                @error('cantidad_producto')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <button type="button" id="agregar_producto" class="inline-block px-4 py-2 mt-2 bg-blue-500 text-white rounded">Agregar Producto</button>
          </div>

          <!-- Tabla de productos agregados -->
          <div class="overflow-x-auto">
            <table id="productos_agregados" class="min-w-full border-2 border-blue-500 rounded-lg">
              <thead>
                <tr>
                  <th class="py-2 px-4 border-b text-left">Producto</th>
                  <th class="py-2 px-4 border-b text-left">Cantidad</th>
                  <th class="py-2 px-4 border-b text-left">Precio Unitario</th>
                  <th class="py-2 px-4 border-b text-left">Total</th>
                  <th class="py-2 px-4 border-b text-left">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach(old('productos', []) as $index => $producto)
                  <tr>
                    <td>{{ $producto['nombre'] }}</td>
                    <td>{{ $producto['cantidad'] }}</td>
                    <td>{{ $producto['precio'] }}</td>
                    <td>{{ $producto['total'] }}</td>
                    <td>
                      <button type="button" class="eliminar_producto">
                        <!-- Icono de eliminación -->
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          @error('total')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror

          <div class="mb-4 flex">
            <label for="total" class="block mb-2 font-semibold">Total de Productos comprados:</label>
            <input type="number" name="total" id="total" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="1" min="0" placeholder="Ingrese el total" value="{{ old('total') }}">
            @error('total')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>  

          <input type="hidden" name="creado_por" value="{{ Auth::user()->name }}">

          <div>
            <input type="submit" value="Registrar" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
          </div>
        </form>
      </div>
    </div>
    <div class="col-span-1 md:col-span-1">
      <div class="sticky top-0 h-screen p-4 rounded-lg">
        <div class="flex flex-col items-center justify-center gap-4 bg-blue-500/13 rounded-lg p-4">
          <a href="{{ route('compras.show') }}">
            <img src="{{ asset('img/compras.png') }}" alt="Imagen" class="flex flex-col justify-center w-48 h-48 rounded-sm">
            <h3 class="text-blue-700 text-center">Ver Compras</h3>
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
    const cantidadProductoInput = document.getElementById('cantidad_producto');
    const productosAgregados = document.getElementById('productos_agregados').getElementsByTagName('tbody')[0];
    const totalProductosInput = document.getElementById('total');
    const costoTotal = document.getElementById('costo_total');

    agregarProductoBtn.addEventListener('click', function () {
      const selectedProduct = productoSelect.options[productoSelect.selectedIndex];
      const cantidad = parseFloat(cantidadProductoInput.value);

      if (selectedProduct.value === "") {
        alert('Seleccione un producto.');
        return;
      }

      if (isNaN(cantidad) || cantidad <= 0) {
        alert('Ingrese una cantidad válida.');
        return;
      }

      const precioCompra = parseFloat(selectedProduct.getAttribute('data-precio-compra'));
      const total = precioCompra * cantidad;

      let productoAgregado = false;
      const rows = productosAgregados.getElementsByTagName('tr');
      for (const row of rows) {
        const productCell = row.querySelector('td:nth-child(1)');
        if (productCell.textContent === selectedProduct.text) {
          const cantidadCell = row.querySelector('td:nth-child(2)');
          const precioCell = row.querySelector('td:nth-child(3)');
          const totalCell = row.querySelector('td:nth-child(4)');

          const nuevaCantidad = parseFloat(cantidadCell.textContent) + cantidad;
          const nuevoTotal = nuevaCantidad * precioCompra;

          cantidadCell.textContent = nuevaCantidad;
          totalCell.textContent = nuevoTotal.toFixed(2);

          productoAgregado = true;
          break;
        }
      }

      if (!productoAgregado) {
        agregarProducto(selectedProduct.text, cantidad, precioCompra, total);
      }

      let totalActual = parseFloat(totalProductosInput.value) || 0;
      totalActual += total;
      totalProductosInput.value = totalActual.toFixed(2);

      cantidadProductoInput.value = '';
    });

    productosAgregados.addEventListener('click', function (event) {
      if (event.target.classList.contains('eliminar_producto')) {
        const row = event.target.closest('tr');
        const total = parseFloat(row.querySelector('td:nth-child(4)').textContent);

        let totalActual = parseFloat(totalProductosInput.value) || 0;
        totalActual -= total;
        totalProductosInput.value = totalActual.toFixed(2);

        row.remove();

        if (productosAgregados.getElementsByTagName('tr').length === 0) {
          totalProductosInput.value = '0.00';
        }

        // Update the nombre_producto input field
        updateNombreProductoInput();
      }
    });


    function updateNombreProductoInput() {
      const nombresProductos = Array.from(productosAgregados.getElementsByTagName('tr')).map(row =>
        row.querySelector('td:nth-child(1)').textContent
      );

      const nombreProductoInput = document.getElementById('nombre_producto');
      nombreProductoInput.value = nombresProductos.join(', ');
    }

    function agregarProducto(nombre, cantidad, precio, total) {
      const newRow = productosAgregados.insertRow();
      newRow.innerHTML = `
        <td>${nombre}</td>
        <td>${cantidad}</td>
        <td>${precio}</td>
        <td>${total.toFixed(2)}</td>
        <td><button type="button" class="eliminar_producto">
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red" viewBox="0 0 256 256">
            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
            </path>
          </svg>
        </button></td>
      `;

      let costoTotalActual = parseFloat(costoTotal.textContent) || 0;
      costoTotalActual += total;
      costoTotal.textContent = costoTotalActual.toFixed(2);

      // Actualizar el campo oculto nombre_producto
      const nombreProductoInput = document.getElementById('nombre_producto');
      const nombresActuales = nombreProductoInput.value;
      if (nombresActuales !== "") {
        nombreProductoInput.value = `${nombresActuales}, ${nombre}`;
      } else {
        nombreProductoInput.value = nombre;
      }
    }
  });
</script>
@endpush
