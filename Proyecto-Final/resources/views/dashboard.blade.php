@extends('layouts.app')

@section('titulo')
   Dashboard
@endsection

@section('nav')
<div class="container sticky top-0 z-sticky">
  <div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 flex-0">
      <!-- Navbar para el contenido del nav que es desplegable en todas las pantallas-->
      <nav class="absolute top-0 left-0 right-0 z-30 flex flex-wrap items-center px-4 py-2 m-6 mb-0 shadow-sm rounded-xl bg-sky-100/70 backdrop-blur-2xl backdrop-saturate-200 lg:flex-nowrap lg:justify-start">
        <div class="flex items-center justify-between w-full p-0 px-6 mx-auto flex-wrap-inherit">
          <a class="py-1.75 text-sm mr-4 ml-4 whitespace-nowrap font-bold text-slate-700 lg:ml-0" href="{{route('post_index')}}" target="_blank"> Proyecto Final </a>
          <button navbar-trigger class="px-3 py-1 ml-2 leading-none transition-all ease-in-out bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-lg lg:hidden" type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6 h-6 bg-none">
              <span bar1 class="w-5.5 rounded-xs relative my-0 mx-auto block h-px bg-blue-500 transition-all duration-300"></span>
              <span bar2 class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-blue-500 transition-all duration-300"></span>
              <span bar3 class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-blue-500 transition-all duration-300"></span>
            </span>
          </button>
          <div navbar-menu class="items-center flex-grow transition-all duration-500 lg-max:overflow-hidden ease lg-max:max-h-0 basis-full lg:flex lg:basis-auto">
            <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
              <li>
                @auth
                <nav class="flex gap-2 items-center">
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button type="submit"
                            class="block px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-sm text-slate-700 lg:px-2  hover:bg-blue-300 rounded-md ease-nav-brand">
                            <i class="fas fa-sign-out-alt lg:mr-1"></i>
                            Cerrar sesión
                        </button>
                    </form>
                </nav>
                @endauth
              </li>
              @guest
              <li>
                <a class="block px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-sm text-slate-700 lg:px-2 hover:bg-blue-300 rounded-md ease-nav-brand" href="{{route('login')}}">
                  <i class="mr-1 fas fa-key opacity-60"></i>
                  Iniciar Sesion
                </a>
              </li>
              @endguest
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>
@endsection



@section('contenido')
<style>
  .container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  
  .card {
    width: calc(33.33% - 40px);
    margin-bottom: 40px;
    font-size: 24px;
    transition: transform 0.5s;
  }
  
  .card:hover {
    transform: scale(1.15);
  }
</style>

<div class="container mx-auto " style="margin-top: 1.5cm;">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div class="col-span-1/2 md:col-span-1/2"></div> <!-- Espacio en blanco para el menú lateral -->
      <div class="col-span-2 md:col-span-3 ">
        <div class="container">
          <div class="card">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Productos</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Producto::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      {{-- <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i> --}}

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="card">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Categorias</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Categoria::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      {{-- <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i> --}}

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="card">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Subcategorías</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Subcategoria::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      {{-- <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i> --}}

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="card">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Ventas</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Venta::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      {{-- <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i> --}}

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="card">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Devoluciones</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Devolucion::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      {{-- <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i> --}}

                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection
