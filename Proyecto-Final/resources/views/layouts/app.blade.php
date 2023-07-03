<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Elimina estilos --}}
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        {{-- @vite('resources/css/styles.css') --}}
        <title>PF @yield('titulo')</title>
        @stack('styles')
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        {{-- <link href="https://cdn.jsdelivr.net/npm/argon-design-system@1.1.0/dist/css/argon.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/argon-design-system@1.1.0/dist/js/argon.min.js"></script> --}}
        <!-- Styles -->
    </head>
    {{-- Cuerpo principal --}}
    <body class="m-0 font-sans text-base antialiased font-normal leading-default h-full">
        <div class="min-h-full">
            <nav class="">
                <div class="mx-auto max-w-7xl py-2">
                    <div class="flex h-16 items-center justify-between">
                        <div class="container mx-auto flex justify-between items-center">
                            <div class="flex-shrink-0">
                                <h1 class="text-3xl font-bold text-white">@yield('titulo')</h1>
                            </div>
                            <div class="hidden md:block">
                                <div class="ml-10 flex items-baseline space-x-4">
                                    @auth
                                    <nav class="flex gap-2 items-center">
                                        <form method="POST" action="{{route('logout')}}">
                                            @csrf
                                            <button type="submit"
                                                class="block px-3 py-2 text-lg font-semibold text-white hover:bg-blue-300 rounded-md transition-all ease-nav-brand">
                                                <i class="fas fa-sign-out-alt lg:mr-1"></i>
                                                <span class="hidden lg:inline">log Out</span>
                                            </button>
                                        </form>
                                    </nav>
                                    @endauth

                                    @guest
                                    <div class="hidden md:block">
                                        <div class="ml-10 flex items-baseline space-x-4">
                                            <li class="flex items-center">
                                                <a href="{{route('login')}}"
                                                    class="block px-3 py-2 text-lg font-semibold text-white hover:bg-blue-300 rounded-md transition-all ease-nav-brand">
                                                    <i class="fa fa-user lg:mr-1"></i>
                                                    <span class="hidden lg:inline">Sign In</span>
                                                </a>
                                            </li>
                                        </div>
                                    </div>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Crear un contenedor dinamico -->
            @yield('nav')

            @yield('header')
            <main class="container mx-auto mt-10">
                {{-- <h2 class="font-black text-blue-500 text-center text-3xl mb-10">
                  @yield('titulo')
              </h2> --}}
                <!-- COntenedor para traer el contenido de las diferentes frames .blade.php -->
                @yield('contenido')
            </main>
        </div>
        {{-- Diseño del footer es decir el pie de pagina --}}
        <footer class="text-slate-300 ">
            <div class="container mx-auto px-4 text-lg text-center py-4">
                <p class="text-white">Copyright &copy; Cesar, Jorge y Juan
                    <span id="date"></span>. all rights reserved {{now()->year}}</p>
            </div>
        </footer>
    </body>
</html>
