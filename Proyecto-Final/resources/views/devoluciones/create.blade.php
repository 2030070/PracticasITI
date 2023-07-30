@extends('layouts.app')

@section('titulo')
   Crear Devolucion
@endsection

@section('contenido')
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
      <div class="col-span-1 md:col-span-2">
        <div class="">
          <form action="{{ route('devoluciones.store') }}" method="POST">
              @csrf
              
              <div class="mb-4 flex">
                <div class="w-1/2 mr-2">
                  <label for="nombre_producto" class="block mb-2 font-semibold">Nombre de Producto:</label>
                  <input type="text" name="nombre_producto" id="nombre_producto" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el nombre del producto">
                </div>
                <div class="w-1/2 ml-2">
                  <label for="fecha_devolucion" class="block mb-2 font-semibold">Fecha de Devolución:</label>
                  <input type="date" name="fecha_devolucion" id="fecha_devolucion" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-auto appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" >
                </div>
              </div>

              <div class="mb-4 flex">
                <div class="w-1/2 mr-2">
                  <label for="cliente" class="block mb-2 font-semibold">Nombre de Cliente:</label>
                  <select name="cliente" id="cliente" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    <option value="">Seleccione el nombre del cliente</option>
                    @foreach($clientes as $cliente)
                      <option value="{{ $cliente->nombre }}" {{ old('cliente') == $cliente->nombre ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                    @endforeach
                  </select>
                  @error('cliente')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
                
                </div>

                <div class="w-1/2 ml-2">
                  <label for="estatus" class="block mb-2 font-semibold">Estatus:</label>
                    <select name="estatus" id="estatus" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estatus de la venta">
                      <option value="">Seleccione el estatus</option>
                      <option value="recibida">Recibida</option>
                      <option value="pendiente">Pendiente</option>

                    </select>
                </div>
              </div>
              <div class="mb-4 flex">
                <div class="w-1/2 mr-2">
                    <label for="precio_total" class="block mb-2 font-semibold">Precio de Total:</label>
                    <input type="number" name="precio_total" id="precio_total" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el precio total">
                </div>
                <div class="w-1/2 ml-2">
                  <label for="pagado" class="block mb-2 font-semibold">Pagado:</label>
                  <input type="number" name="pagado" id="pagado" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el pago">
                </div>        
              </div>

              <div class="mb-4 flex">
                  <div class="w-1/2 mr-2">
                      <label for="adeudo" class="block mb-2 font-semibold">Adeudo:</label>
                      <input type="number" name="adeudo" id="adeudo" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el adeudo">
                  </div>
                  <div class="w-1/2 ml-2">
                    <label for="estatus_pago" class="block mb-2 font-semibold">Estatus de pago:</label>
                      <select name="estatus_pago" id="estatus_pago" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estatus del pago">
                        <option value="">Seleccione el estatus</option>
                        <option value="recibida">Pagado</option>
                        <option value="pendiente">No pagado</option>

                      </select>
                  </div>        
              </div>
 
              <input type="hidden" name="creado_por" value="{{ Auth::user()->name }}">
              
              <div>
                <input type="submit" value="Registrar" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
              </div>
          </form>
        </div>
      </div>
    {{-- <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral --> --}}
    <div class="col-span-1 md:col-span-1">
      <div class="sticky top-0 h-screen p-4 rounded-lg">
        <div class="flex flex-col items-center justify-center gap-4 bg-blue-500/13 rounded-lg p-4">
          <a href="{{ route('devoluciones.show') }}">
            <img src="{{ asset('img/devoluciones.png') }}" alt="Imagen" class="flex flex-col justify-center w-48 h-48 rounded-sm">
            <h3 class="text-blue-700 text-center">Ver Devoluciones</h3>
          </a> 
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
