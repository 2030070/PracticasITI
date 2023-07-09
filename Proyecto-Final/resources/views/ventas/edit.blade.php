@extends('layouts.app')

@section('titulo')
Editar Venta
@endsection

@section('contenido')

<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
      <div class="col-span-1 md:col-span-2">
        <div class="">
          <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-4 flex">
                <div class="w-1/2 mr-2">
                  <label for="fecha" class="block mb-2 font-semibold">Fecha:</label>
                  <input type="date" name="fecha" id="fecha" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-auto appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" value="{{ $venta->fecha }}">
                </div>
                <div class="w-1/2 ml-2">
                  <label for="nombre_cliente" class="block mb-2 font-semibold">Nombre de Cliente:</label>
                  <input type="text" name="nombre_cliente" id="nombre_cliente" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Ingrese el nombre del cliente" value="{{ $venta->nombre_cliente }}">
                </div>
              </div>
    
              <div class="mb-4 flex">
                <div class="w-1/2 mr-2">
                  <label for="referencia" class="block mb-2 font-semibold">Referencia:</label>
                  <input type="text" name="referencia" id="referencia" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Ingrese la referencia" value="{{ $venta->referencia }}">
                </div>
    
                <div class="w-1/2 ml-2">
                  <label for="estatus" class="block mb-2 font-semibold">Estatus de Venta:</label>
                    <select name="estatus" id="estatus" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estatus de la venta">
                      <option value="">Seleccione el estatus</option>
                      <option value="en_proceso" {{ $venta->estatus == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                      <option value="completada" {{ $venta->estatus == 'completada' ? 'selected' : '' }}>Completada</option>
                      <option value="cancelada" {{ $venta->estatus == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>
              </div>
              <div class="mb-4 flex">
                <div class="w-1/2 mr-2">
                    <label for="pago" class="block mb-2 font-semibold">Pago:</label>
                    <select name="pago" id="pago" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estado de pago">
                      <option value="">Seleccione el estado de pago</option>
                      <option value="hecho" {{ $venta->pago == 'hecho' ? 'selected' : '' }}>Hecho</option>
                      <option value="pendiente" {{ $venta->pago == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    </select>
                </div>
                <div class="w-1/2 ml-2">
                  <label for="total" class="block mb-2 font-semibold">Total:</label>
                  <input type="number" name="total" id="total" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el total" value="{{ $venta->total }}">
                </div>        
              </div>
    
              <div class="mb-4 flex">
                  <div class="w-1/2 mr-2">
                      <label for="pago_parcial" class="block mb-2 font-semibold">Pago Parcial:</label>
                      <input type="number" name="pago_parcial" id="pago_parcial" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el pago parcial" value="{{ $venta->pago_parcial }}">
                  </div>
                  <div class="w-1/2 ml-2">
                    <label for="pago_pendiente" class="block mb-2 font-semibold">Pago Pendiente:</label>
                    <input type="number" name="pago_pendiente" id="pago_pendiente" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el pago pendiente" value="{{ $venta->pago_pendiente }}">
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
      