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
        <li class="mt-0.5 w-full">
          <nav class=" py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors">
            <form method="POST" action="{{route('logout')}}">
                @csrf
                <button type="submit"
                    class="block px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-sm text-slate-700 lg:px-2  hover:bg-blue-300 rounded-md ease-nav-brand">
                    <i class="fas fa-sign-out-alt lg:mr-1"></i>
                    Cerrar sesión
                </button>
            </form>
        </nav>
        </li>
      </ul>
    </div>

    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />

  </aside>
  <!-- end sidenav -->
@endsection


@section('contenido')

@endsection
