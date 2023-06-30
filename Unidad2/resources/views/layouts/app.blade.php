<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Elimina estilos --}}
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        {{-- @vite('resources/css/styles.css') --}}
        <title>Facturas @yield('titulo')</title>
        @stack('styles')
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Styles -->
        
    </head>
    {{-- Cuerpo principal --}}
    <body class="h-full">
        <div class="min-h-full">
            {{-- seccion del menu de opciones --}}
            <nav class="bg-gray-800">
              <div class="mx-auto max-w-7xl py-3">
                <div class="flex h-16 items-center justify-between">
                  <div class="container mx auto flex justify-between items-center">
                    <div class="flex-shrink-0">
                      {{-- {{route('post_index',[auth()->user()->username])}} --}}
                        <h1 class="text-3xl font-bold text-white"><a href="#">Facturas</a></h1>
                    </div>
                    <div class="hidden md:block">
                      <div class="ml-10 flex items-baseline space-x-4">
                        @auth
                          {{-- vinculo para boton de publicar un post --}}
                          <a href=""  class="felx item-center gap-2 text-bold text-gray-200 rounded text-sm uppercase font-font-bold cursor-pointer">Empresas Emisoras</a>
                          <a href=""  class="felx item-center gap-2 text-bold text-gray-200 rounded text-sm uppercase font-font-bold cursor-pointer">Empresas Receptoras</a>
                          <a href=""  class="felx item-center gap-2 text-bold text-gray-200 rounded text-sm uppercase font-font-bold cursor-pointer">Facturas</a>
                          <a href=""  class="felx item-center gap-2 text-bold text-gray-200 rounded text-sm uppercase font-font-bold cursor-pointer">Búsqueda</a>

                          <nav class="flex gap-2 items-center text-gray-200" >
                          
                            {{-- Agregar seguridad al logout --}}
                            <form method="POST" action="{{route('logout')}}">
                              @csrf
                              <button type="submit" class="font-bold uppercase text-bold text-gray-200 text-sm">
                                Cerrar Sesión
                              </button>
                            </form>

                          </nav>
                        @endauth

                        @guest
                          <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                              <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href="{{route('login')}}"> Login</a>
                                <a href=""  class="felx item-center gap-2  text-gray-200 rounded text-sm uppercase font-font-bold cursor-pointer">Búsqueda</a>
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
              <h2 class="font-black text-center text-3xl mb-10">
                  @yield('titulo')
              </h2>
              <!-- COntenedor para traer el contenido de las diferentes frames .blade.php -->
              @yield('contenido')
            </main>
        </div>
        {{-- Diseño del footer es decir el pie de pagina --}}
        <footer class="bg-gray-800 py-4">
          <div class="container mx-auto px-4 text-gray-300 text-center text-lg" >
              <p>Copyright &copy; César Aldahir Flores Gámez
                  <span id="date"></span>. all rights reserved {{now()->year}}</p>
          </div>
        </footer>
    </body>
</html>
