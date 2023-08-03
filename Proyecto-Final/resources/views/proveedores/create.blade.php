@extends('layouts.app')

@section('titulo')
   Registrar Proveedor
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <form action="{{ route('proveedores.store') }}" method="POST">
                    @csrf

                    <div class="mb-4 flex">
                        <div class="w-1/2 mr-2">
                            <label for="codigo" class="block mb-2 font-semibold">Código:</label>
                            <input type="text" name="codigo" id="codigo" placeholder="Ingrese el código del proveedor" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        </div>
            
                          <div class="w-1/2 ml-2">
                            <label for="nombre" class="block mb-2 font-semibold">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre del proveedor" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        </div>
                    </div>

                    <div class="mb-4 flex">
                        <div class="w-1/2 mr-2">
                            <label for="telefono" class="block mb-2 font-semibold">Teléfono:</label>
                            <input type="text" name="telefono" id="telefono" placeholder="Ingrese el teléfono del proveedor" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        </div>
            
                          <div class="w-1/2 ml-2">
                            <label for="email" class="block mb-2 font-semibold">Correo electrónico:</label>
                            <input type="email" name="email" id="email" placeholder="Ingrese el correo electrónico del proveedor" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        </div>
                    </div>

                    <div class="mb-4 flex">
                      <div class="w-1/2 mr-2">
                          <label for="pais" class="block mb-2 font-semibold">País:</label>
                          <input type="text" name="pais" id="pais" placeholder="Ingrese el país" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none">
                      </div>
                      
                      <div class="w-1/2 ml-2">
                          <label for="estado" class="block mb-2 font-semibold">Estado:</label>
                          <input type="text" name="estado" id="estado" placeholder="Ingrese el estado" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none">
                      </div>
                  </div>
                  
                  <div class="mb-4 flex">
                      <div class="w-1/2 mr-2">
                          <label for="ciudad" class="block mb-2 font-semibold">Ciudad:</label>
                          <input type="text" name="ciudad" id="ciudad" placeholder="Ingrese la ciudad" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none">
                      </div>
                  </div>
                    

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
                <a href="{{ route('proveedores.show') }}">
                  <img src="{{ asset('img/proveedores.png') }}" alt="Imagen" class="flex flex-col justify-center w-48 h-48 rounded-sm">
                  <h3 class="text-blue-700 text-center">Ver Proveedores</h3>
                </a> 
              </div>
            </div>
          </div>
          
    </div>
</div>
@endsection
