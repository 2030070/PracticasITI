@extends('layouts.app')

@section('titulo')
   Editar Devolución
@endsection

@section('contenido')
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
      <div class="col-span-1 md:col-span-2">
        <div class="">
          <form action="{{ route('devoluciones.update', $devolucion->id) }}" method="POST">
              @csrf
              @method('PUT')
              
              <div class="mb-4 flex">
                <div class="w-1/2 mr-2">
                  <label for="nombre_producto" class="block mb-2 font-semibold">Nombre de Producto:</label>
                  <select name="nombre_producto" id="nombre_producto" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    <option value="">Seleccione el producto</option>
                    @foreach($productos as $producto)
                      <option value="{{ $producto->nombre }}" {{ $devolucion->producto == $producto->nombre ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="w-1/2 ml-2">
                  <label for="fecha_devolucion" class="block mb-2 font-semibold">Fecha de Devolución:</label>
                  <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-auto appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" value="{{ $devolucion->fecha_devolucion }}">
                </div>
              </div>

              <div class="mb-4 flex">
                <div class="w-1/2 mr-2">
                  <label for="cliente" class="block mb-2 font-semibold">Nombre de Cliente:</label>
                  <select name="cliente" id="cliente" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    <option value="">Seleccione el nombre del cliente</option>
                    @foreach($clientes as $cliente)
                      <option value="{{ $cliente->nombre }}" {{ $devolucion->cliente == $cliente->nombre ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="w-1/2 ml-2">
                  <label for="estatus" class="block mb-2 font-semibold">Estatus:</label>
                    <select name="estatus" id="estatus" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estatus de la venta">
                      <option value="">Seleccione el estatus</option>
                      <option value="recibida" {{ $devolucion->estatus == 'recibida' ? 'selected' : '' }}>Recibida</option>
                      <option value="pendiente" {{ $devolucion->estatus == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    </select>
                </div>
              </div>
              <div class="mb-4 flex">
                <div class="w-1/2 mr-2">
                    <label for="precio_total" class="block mb-2 font-semibold">Precio de Total:</label>
                    <input type="number" name="precio_total" id="precio_total" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el precio total" value="{{ $devolucion->precio_total }}">
                </div>
                <div class="w-1/2 ml-2">
                  <label for="pagado" class="block mb-2 font-semibold">Pagado:</label>
                  <input type="number" name="pagado" id="pagado" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el pago" value="{{ $devolucion->pagado }}">
                </div>        
              </div>

              <div class="mb-4 flex">
                 <div class="w-1/2 mr-2">
                      <label for="adeudo" class="block mb-2 font-semibold">Adeudo:</label>
                      <input type="number" name="adeudo" id="adeudo" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el adeudo" value="{{ $devolucion->adeudo }}">
                  </div>
                  <div class="w-1/2 ml-2">
                    <label for="estatus_pago" class="block mb-2 font-semibold">Estatus de pago:</label>
                      <select name="estatus_pago" id="estatus_pago" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estatus del pago">
                        <option value="">Seleccione el estatus</option>
                        <option value="recibida" {{ $devolucion->estatus_pago == 'recibida' ? 'selected' : '' }}>Pagado</option>
                        <option value="pendiente" {{ $devolucion->estatus_pago == 'pendiente' ? 'selected' : '' }}>No pagado</option>
                      </select>
                  </div>        
              </div>
 
              <input type="hidden" name="creado_por" value="{{ Auth::user()->name }}">
              
              <div>
                <input type="submit" value="Actualizar" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
              </div>
          </form>
        </div>
      </div>
    <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
  </div>
</div>
@endsection
