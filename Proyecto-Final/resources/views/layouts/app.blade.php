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
            <!-- Crear un contenedor dinamico para el nav, header y el cuerpo del contenido -->
            @yield('nav')
            @auth
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
                                        <i class="relative top-0 text-sm leading-normal text-blue-500 fas fa-box-open"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Productos</span>
                                </a>
                            </li>

                            <li class="mt-0.5 w-full">
                                <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('categorias.create') }}">
                                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class="relative top-0 text-sm leading-normal text-blue-500 fas fa-folder-plus"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Categorías</span>
                                </a>
                            </li>
                            <li class="mt-0.5 w-full">
                                <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('subcategorias.create') }}">
                                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class="relative top-0 text-sm leading-normal text-blue-500 fas fa-folder-plus"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Subcategorias</span>
                                </a>
                            </li>
                            <li class="mt-0.5 w-full">
                                <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors" href="{{ route('marcas.create') }}">
                                    <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                        <i class="relative top-0 text-sm leading-normal text-blue-500 fas fa-folder-plus"></i>
                                    </div>
                                    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Marcas</span>
                                </a>
                            </li>
                            <li class="mt-0.5 w-full">
                                <form method="POST" action="{{route('logout')}}">
                                    @csrf
                                    <button type="submit">
                                        <a class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors">
                                            <div class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-center stroke-0 text-center xl:p-2.5">
                                                <i class="relative top-0 text-sm leading-normal text-blue-500  fas fa-sign-out-alt "></i>
                                            </div>
                                            <span class="ml-1 duration-300 opacity-100 pointer-events-none ease">Cerrar Sesion</span>
                                        </a>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
                </aside>
            <!-- end sidenav -->
            @endauth

            <main class="container mx-auto mt-10">
                @yield('contenido')
            </main>
        </div>
        @stack('scripts')
        {{-- Diseño del footer es decir el pie de pagina --}}
        <footer>
            <div class="container mx-auto px-4 text-lg text-center py-4">
                <p class="text-blue-500">Copyright &copy;
                    <span id="date"></span>. all rights reserved {{now()->year}}</p>
            </div>
        </footer>
    </body>
</html>
