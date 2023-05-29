<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Elimina estilos --}}
        @vite('resources/css/app.css')
        {{-- @vite('resources/css/styles.css') --}}
        <title>Portal - @yield('titulo')</title>

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
                        {{-- <img class="h-8 w-8" src="./imagenes/c.png" alt="Your Company"> --}}
                        <h1 class="text-3xl font-bold text-white"><a href="/">Devstagram</a></h1>
                    </div>
                    <div class="hidden md:block">
                      <div class="ml-10 flex items-baseline space-x-4">
                        @auth
                            <nav class="flex gap-2 items-center text-gray-200" >
                              Hola:<span class="font-normal">
                                {{auth()->user()->username}}  
                              </span>   
                              {{-- Agregar seguridad al logout --}}
                              <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <button type="submit" class="font-bold uppercase text-gray-200 text-sm">
                                  Cerrar Sesión
                                </button>
                              </form>

                            </nav>
                        @endauth

                        @guest
                          <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                              <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href="{{route('login')}}"> Login</a>
                              <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"  href="{{route('register')}}"> Crear usuario</a>
                            </div>
                          </div> 
                        @endguest
                        {{-- <!-- Current: "bg-gray-900 text-white" este es para poner un sombreado en la parte del texto
                            , Default: "text-gray-300 hover:bg-gray-700 hover:text-white" este es para que no lo tenga-->
                        <a href="/" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Dashboard</a>
                        <a href="/alumnos" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Alumnos</a>
                        <a href="/curriculum" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Curriculum</a>
                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href=""> Login</a>
                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"  href="{{route('register')}}"> Crear usuario</a> --}}
                      </div>
                    </div>
                  </div>
                  <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                      <button type="button" class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                      </button>
          
                      <!-- Profile dropdown -->
                      <div class="relative ml-3">
                        <div>
                          <button type="button" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img src="{{asset ('img/YO.jpg')}}"  class="h-8 w-8 rounded-full" alt="usuarios">
                          </button>
                        </div>
          
                        <!--
                            Seccion de menu desplegable
                          Dropdown menu, show/hide based on menu state.
          
                          Entering: "transition ease-out duration-100"
                            From: "transform opacity-0 scale-95"
                            To: "transform opacity-100 scale-100"
                          Leaving: "transition ease-in duration-75"
                            From: "transform opacity-100 scale-100"
                            To: "transform opacity-0 scale-95"
                            
                        -->
                        
                        {{-- <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" >
                          <!-- Active: "bg-gray-100"se marca cuando se activa la opcion
                            , Not Active: "" -->
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700 " role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                          <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                        </div> --}}
                      </div>
                    </div>
                  </div>
                  <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" class="inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                      <span class="sr-only">Open main menu</span>
                      <!-- Menu open: "hidden", Menu closed: "block" -->
                      <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                      </svg>
                      <!-- Menu open: "block", Menu closed: "hidden" -->
                      <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
          
              <!-- Mobile menu, show/hide based on menu state. -->
              <div class="md:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
                    <!-- Current: "bg-gray-900 text-white" este es para poner un sombreado en la parte del texto
                        , Default: "text-gray-300 hover:bg-gray-700 hover:text-white" este es para que no lo tenga-->
                    <a href="/" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" aria-current="page">Dashboard</a>
                    <a href="/alumnos" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Alumnos</a>
                    <a href="/curriculum" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium">Curriculum</a>
                    <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href=""> Login</a>
                    <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"  href="crearCuenta"> Crear usuario</a>
                  </div>
                <div class="border-t border-gray-700 pb-3 pt-4">
                  <div class="flex items-center px-5">
                    <div>
                      <button type="button" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img src="{{asset ('img/YO.jpg')}}"  class="h-8 w-8 rounded-full" alt="usuarios">
                      </button>
                    </div>
                    <div class="ml-3">
                      <div class="text-base font-medium leading-none text-white">César Flores</div>
                      <div class="text-sm font-medium leading-none text-gray-400">2030070@upv.edu.mx</div>
                    </div>
                    <button type="button" class="ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                      <span class="sr-only">View notifications</span>
                      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                      </svg>
                    </button>
                  </div>
                  {{-- <div class="mt-3 space-y-1 px-2">
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
                  </div> --}}
                </div>
              </div>

            </nav>

            <!-- Crear un contenedor dinamico -->
            @yield('nav')

            <!-- COntenedor para traer el headr de las diferentes frames .blade.php -->
            @yield('header')
            <!-- COntenedor para traer el contenido de las diferentes frames .blade.php -->
            @yield('contenido')
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
