@extends('layouts.app')

@section('titulo')
   Crear Devolucion de {{$producto->nombre}}

   <h2 class="text-3xl text-white">Venta {{$venta->referencia}}</h2>
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
                <div class="w-1/2 ml-2">
                  <label for="fecha_devolucion" class="block mb-2 font-semibold">Fecha de Devolución:</label>
                  <input value="{{$fechaActual}}" type="date" name="fecha_devolucion" id="fecha_devolucion" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-auto appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" >
                </div>

                <div class="w-1/2 ml-2">
                  <label for="descripcion" class="block mb-2 font-semibold">Descripcion:</label>
                  <input placholder="Descripción" type="text" name="descripcion" id="descripcion" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-auto appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" >
                </div>

              </div>

              <div class="mb-4 flex">
                <div class="w-1/2 ml-2">
                  <label for="referencia" class="block mb-2 font-semibold">Referencia:</label>
                  <input placholder="Ingresa la referencia" type="text" name="referencia" id="referencia" placeholder="Ingrese la referencia" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-auto appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                </div>

                <div class="w-1/2 ml-2">
                  <label for="cantidad" class="block mb-2 font-semibold">Cantidad a devolver:</label>
                  <input placholder="Cantidad" max="{{$cantidadMaxima}}" type="number" name="cantidad" id="cantidad" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-auto appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="1" min="0" >
                </div>
              </div>

                <input type="hidden" name="venta_id" value="{{$venta->id}}">
                <input type="hidden" name="producto_id" value="{{$producto->id}}">
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
