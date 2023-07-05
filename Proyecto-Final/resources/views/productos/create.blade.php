@extends('layouts.app')

@section('titulo')
   Crear Producto
@endsection

@section('sliderbar')
  <!-- sidenav -->
  <aside class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0 " aria-expanded="false">
    <div class="h-19 py-14">
      <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 xl:hidden" sidenav-close></i>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

    <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
      <ul class="flex flex-col pl-0 mb-0">
        <li class="mt-0.5 w-full">
          <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('productos.create') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-blue-500 fas fa-plus"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Crear Producto</span>
          </a>
        </li>

        <li class="mt-0.5 w-full">
          <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('categorias.create') }}">
            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
              <i class="relative top-0 text-sm leading-normal text-blue-500 fas fa-plus"></i>
            </div>
            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Crear Categoría</span>
          </a>
        </li>
      </ul>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

  </aside>
  <!-- end sidenav -->
@endsection


@section('contenido')
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">
          <div class="py-20">
              <form action="{{ route('productos.store') }}" method="POST">
                  @csrf

                  <div class="mb-4">
                      <label for="categoria_id" class="block mb-2">Categoría:</label>
                      <select name="categoria_id" id="categoria_id" class="border rounded-lg py-2 px-4 " placeholder="Seleccione una categoría">
                          <option value="">Seleccione una categoría</option>
                          @foreach ($categorias as $categoria)
                              <option value="{{ $categoria->id }}">{{ $categoria->descripcion }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="mb-4">
                      <label for="subcategoria_id" class="block mb-2">Subcategoría:</label>
                      <select name="subcategoria_id" id="subcategoria_id" class="border rounded-lg py-2 px-4 " placeholder="Seleccione una subcategoría">
                          <option value="">Seleccione una subcategoría</option>
                          {{-- @foreach ($subcategorias as $subcategoria)
                              <option value="{{ $subcategoria->id }}">{{ $subcategoria->nombre }}</option>
                          @endforeach --}}
                      </select>
                  </div>

                  <div class="mb-4">
                      <label for="precio_compra" class="block mb-2">Precio de Compra:</label>
                      <input type="number" name="precio_compra" id="precio_compra" class="border rounded-lg py-2 px-4" step="0.01" min="0" placeholder="Ingrese el precio de compra">
                  </div>

                  <div class="mb-4">
                      <label for="precio_venta" class="block mb-2">Precio de Venta:</label>
                      <input type="number" name="precio_venta" id="precio_venta" class="border rounded-lg py-2 px-4" step="0.01" min="0" placeholder="Ingrese el precio de venta">
                  </div>

                  <div class="mb-4">
                      <label for="unidades_disponibles" class="block mb-2">Unidades Disponibles:</label>
                      <input type="number" name="unidades_disponibles" id="unidades_disponibles" class="border rounded-lg py-2 px-4" min="0" placeholder="Ingrese las unidades disponibles">
                  </div>

                  <div class="mb-4">
                      <label for="creado_por" class="block mb-2">Creado por:</label>
                      <input type="text" name="creado_por" id="creado_por" class="border rounded-lg py-2 px-4" placeholder="Ingrese el creador">
                  </div>

                  
                  <div>
                      <input type="submit" value="Registrar"
                          class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 
                          hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md 
                          bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                  </div>
              </form>
          </div>
        </div>
      <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    </div>
</div>
@endsection
