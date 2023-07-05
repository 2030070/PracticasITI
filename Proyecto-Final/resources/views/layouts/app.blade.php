<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Elimina estilos --}}
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        {{-- Titulo de la pagina --}}
        <title>@yield('titulo')</title>

        {{-- Asignación de estilos usando un template --}}
        @stack('styles')
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        @vite('resources/css/nucleo-icons.css')
        @vite('resources/css/nucleo-svg.css')
        @vite('resources/css/argon-dashboard-tailwind.css')
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        @vite('resources/js/plugins/chartjs.min.js')
        @vite('resources/js/plugins/Chart.extension.js')
        @vite('resources/js/plugins/perfect-scrollbar.min.js')
        @vite('resources/js/argon-dashboard-tailwind.js')
        @vite('resources/js/argon-dashboard-tailwind.min.js')
        @vite('resources/js/navbar-sticky.js')
    </head>
    {{-- Cuerpo principal --}}
    <body class="m-0 font-sans text-base antialiased font-normal leading-default h-full">
        <div class="min-h-full">
            {{-- <div class="container sticky top-0 z-sticky">
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
            </div> --}}

            <!-- Crear un contenedor dinamico para el nav, header y el cuerpo del contenido -->
            @yield('nav')
            @yield('sliderbar')
            @yield('header')
            <main class="container mx-auto mt-10">
                @yield('contenido')
            </main>
        </div>
        {{-- Diseño del footer es decir el pie de pagina --}}
        <footer class="text-gray-300 ">
            <div class="container mx-auto px-4 text-lg text-center py-4">
                <p class="text-gray-800">Copyright &copy; Cesar, Jorge y Juan
                    <span id="date"></span>. all rights reserved {{now()->year}}</p>
            </div>
        </footer>
    </body>
</html>
