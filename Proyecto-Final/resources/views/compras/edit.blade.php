@extends('layouts.app')

@section('titulo')
Editar Compra
@endsection

@section('contenido')
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    <div class="col-span-1 md:col-span-2">
      <div class="">
        <form action="{{ route('compras.update', $compra->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="nombre_producto" class="block mb-2 font-semibold">Nombre de Producto:</label>
              <select name="nombre_producto" id="nombre_producto" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                <option value="">Seleccione el nombre del producto</option>
                @foreach($productos as $producto)
                  <option value="{{ $producto->nombre }}" {{ $compra->nombre_producto == $producto->nombre ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                @endforeach
              </select>
              @error('nombre_producto')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div class="w-1/2 ml-2">
              <label for="nombre_proveedor" class="block mb-2 font-semibold">Nombre de Proveedor:</label>
              <select name="nombre_proveedor" id="nombre_proveedor" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                <option value="">Seleccione el nombre del proveedor</option>
                @foreach($proveedores as $proveedor)
                  <option value="{{ $proveedor->nombre }}" {{ $compra->nombre_proveedor == $proveedor->nombre ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                @endforeach
              </select>
              @error('nombre_proveedor')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="referencia" class="block mb-2 font-semibold">Referencia:</label>
              <input type="text" name="referencia" id="referencia" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Ingrese la referencia" value="{{ $compra->referencia }}">
              @error('referencia')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="w-1/2 ml-2">
              <label for="fecha" class="block mb-2 font-semibold">Fecha:</label>
              <input type="date" name="fecha" id="fecha" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-auto appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" value="{{ $compra->fecha }}">
              @error('fecha')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="estatus" class="block mb-2 font-semibold">Estatus de Compra:</label>
                <select name="estatus" id="estatus" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estatus de la compra">
                  <option value="">Seleccione el estatus</option>
                  <option value="en_proceso" {{ $compra->estatus == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                  <option value="completada" {{ $compra->estatus == 'completada' ? 'selected' : '' }}>Completada</option>
                  <option value="cancelada" {{ $compra->estatus == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
                @error('estatus')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-1/2 ml-2">
              <label for="total" class="block mb-2 font-semibold">Total:</label>
              <input type="number" name="total" id="total" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el total" value="{{ $compra->total }}">
              @error('total')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>        
          </div>

          <div class="mb-4 flex">
              <div class="w-1/2 mr-2">
                  <label for="pagado" class="block mb-2 font-semibold">Pagado:</label>
                  <input type="number" name="pagado" id="pagado" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el pagado" value="{{ $compra->pagado }}">
                  @error('pagado')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                  @enderror
              </div>
              <div class="w-1/2 ml-2">
                <label for="pendiente_de_pago" class="block mb-2 font-semibold">Pendiente de Pago:</label>
                <input type="number" name="pendiente_de_pago" id="pendiente_de_pago" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el pendiente de pago" value="{{ $compra->pendiente_de_pago }}">
                @error('pendiente_de_pago')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
              </div>        
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
                <label for="estatus_de_pago" class="block mb-2 font-semibold">Estatus de Pago:</label>
                <select name="estatus_de_pago" id="estatus_de_pago" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estado de pago">
                  <option value="">Seleccione el estado de pago</option>
                  <option value="pagado" {{ $compra->estatus_de_pago == 'pagado' ? 'selected' : '' }}>Pagado</option>
                  <option value="pendiente" {{ $compra->estatus_de_pago == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                </select>
                @error('estatus_de_pago')
                  <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-1/2 ml-2">
              <!-- Aquí podrías agregar más campos relacionados con la compra si los hay -->
            </div>        
          </div>

          <input type="hidden" name="creado_por" value="{{ Auth::user()->name }}">
          
          <div>
            <input type="submit" value="Actualizar" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
          </div>
        </form>
      </div>
    </div>
    {{-- <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral --> --}}
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
