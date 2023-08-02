@extends('layouts.app')

@section('titulo')
   Crear Cotizacion
@endsection

@section('contenido')
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    <div class="col-span-1 md:col-span-2">
      <div class="">
        <form action="{{ route('cotizaciones.store') }}" method="POST">
          @csrf
          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="producto_id" class="block mb-2 font-semibold">Producto:</label>
              <select name="producto_id" id="producto_id" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione una producto">
                <option value="">Seleccione un producto</option>
                @foreach ($productos as $producto)
                  <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
              </select>
            </div>

            <div class="w-1/2 ml-2">
              <label for="referencia" class="block mb-2 font-semibold">Referencia:</label>
              <input type="text" name="referencia" id="referencia" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Referencia">
            </div>
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="cliente_id" class="block mb-2 font-semibold">Cliente:</label>
              <select name="cliente_id" id="cliente_id" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione un cliente">
                <option value="">Seleccione un cliente:</option>
                @foreach ($clientes as $cliente)
                  <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
              </select>
            </div>

              <div class="w-1/2 ml-2">
                <label for="estatus" class="block mb-2 font-semibold">estatus:</label>
                <select name="estatus" id="estatus" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el estatus">>
                  <option value="">Seleccione el estatus</option>
                  <option value="enviada">Enviada</option>
                  <option value="pendiente">Pendiente</option>
              </select>
            </div>
          </div>


          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="total_producto" class="block mb-2 font-semibold">Total:</label>
              <select name="total_producto" id="total_producto" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione el precio">
                <option value="">Seleccione el precio total:</option>
                @foreach ($productos as $producto)
                  <option value="{{ $producto->id }}">{{ $producto->precio_compra }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div>
            <input type="submit" value="Registrar" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
          </div>
        </form>
      </div>
    </div>
    {{-- <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
     --}}
    <div class="col-span-1 md:col-span-1">
      <div class="sticky top-0 h-screen p-4 rounded-lg">
        <div class="flex flex-col items-center gap-4 bg-blue-500/13 rounded-lg p-4">
          <a href="{{route('cotizaciones.show')}}">
            <img src="{{ asset('img/cotizacion.png') }}" alt="Imagen" class="w-48 h-48 rounded-sm">
            <h3 class="text-blue-700">Ver Cotizaciones</h3>
          </a> 
        </div>
      </div>
    </div>
    
    
  </div>
</div>
@endsection
