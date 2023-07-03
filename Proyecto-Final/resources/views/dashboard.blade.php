@extends('layouts.app')

@section('titulo')
   Dashboard
@endsection

@push('styles')
    <style>
        /* Estilos adicionales */
        .box {
            transition: transform 0.3s;
            color: #ffffff;
            background-color: #4085cf;
        }
        .box:hover {
            transform: scale(1.1);
        }
    </style>
@endpush

@section('contenido')
<body class="m-0 font-sans text-base antialiased font-normal leading-default text-slate-800 h-full">
    @auth
        <div class="grid grid-cols-2 gap-4 justify-center items-center">
            <!-- Tabla de datos -->
            <div class="bg-white rounded-lg p-4 hover-float box col-span-1">
                <h2 class="text-lg font-semibold mb-4">Tabla de datos</h2>
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Nombre</th>
                            <th class="text-left">Edad</th>
                            <th class="text-left">Ciudad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>30</td>
                            <td>New York</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>25</td>
                            <td>London</td>
                        </tr>
                        <!-- Agrega más filas de ejemplo aquí -->
                    </tbody>
                </table>
            </div>

            <!-- Indicador numérico -->
            <div class="bg-white rounded-lg p-4 hover-float box col-span-1">
                <h2 class="text-lg font-semibold mb-2">Ventas Mensuales</h2>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-2xl font-bold">250</span>
                </div>
            </div>

        
            <div class="grid grid-flow-col grid-rows-2 grid-cols-3 gap-8">
                <div class="blur">
                  <img src="img/fondo2.jpg" alt="" loading="lazy">
                </div>
                <div class="col-start-3 sepia">
                  <img src="img/fondo2.jpg" alt="" loading="lazy">
                </div>
                <div class="saturate-200">
                  <img src="img/fondo2.jpg" alt="" loading="lazy">
                </div>
                <div class="grayscale">
                  <img src="img/fondo2.jpg" alt="" loading="lazy">
                </div>
                <div class="row-start-1 col-start-2 col-span-2 invert">
                  <img src="img/fondo2.jpg" alt="" loading="lazy">
                </div>
            </div>
            <div class="flex font-sans">
                <div class="flex-none w-56 relative">
                  <img src="img/yo.jpg" alt="" class="absolute inset-0 w-full h-full object-cover rounded-lg" loading="lazy" />
                </div>
                <form class="flex-auto p-6">
                  <div class="flex flex-wrap">
                    <h1 class="flex-auto font-medium text-slate-900">
                      Kids Jumpsuit
                    </h1>
                    <div class="w-full flex-none mt-2 order-1 text-3xl font-bold text-violet-600">
                      $39.00
                    </div>
                    <div class="text-sm font-medium text-slate-400">
                      In stock
                    </div>
                  </div>
                  <div class="flex items-baseline mt-4 mb-6 pb-6 border-b border-slate-200">
                    <div class="space-x-2 flex text-sm font-bold">
                      <label>
                        <input class="sr-only peer" name="size" type="radio" value="xs" checked />
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-violet-400 peer-checked:bg-violet-600 peer-checked:text-white">
                          XS
                        </div>
                      </label>
                      <label>
                        <input class="sr-only peer" name="size" type="radio" value="s" />
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-violet-400 peer-checked:bg-violet-600 peer-checked:text-white">
                          S
                        </div>
                      </label>
                      <label>
                        <input class="sr-only peer" name="size" type="radio" value="m" />
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-violet-400 peer-checked:bg-violet-600 peer-checked:text-white">
                          M
                        </div>
                      </label>
                      <label>
                        <input class="sr-only peer" name="size" type="radio" value="l" />
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-violet-400 peer-checked:bg-violet-600 peer-checked:text-white">
                          L
                        </div>
                      </label>
                      <label>
                        <input class="sr-only peer" name="size" type="radio" value="xl" />
                        <div class="w-9 h-9 rounded-full flex items-center justify-center text-violet-400 peer-checked:bg-violet-600 peer-checked:text-white">
                          XL
                        </div>
                      </label>
                    </div>
                  </div>
                  <div class="flex space-x-4 mb-5 text-sm font-medium">
                    <div class="flex-auto flex space-x-4">
                      <button class="h-10 px-6 font-semibold rounded-full bg-violet-600 text-white" type="submit">
                        Buy now
                      </button>
                      <button class="h-10 px-6 font-semibold rounded-full border border-slate-200 text-slate-900" type="button">
                        Add to bag
                      </button>
                    </div>
                    <button class="flex-none flex items-center justify-center w-9 h-9 rounded-full text-violet-600 bg-violet-50" type="button" aria-label="Like">
                      <svg width="20" height="20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" />
                      </svg>
                    </button>
                  </div>
                  <p class="text-sm text-slate-500">
                    Free shipping on all continental US orders.
                  </p>
                </form>
              </div>
              
        </div>
    @endauth
</body>
@endsection
