<!DOCTYPE html>
<html  class="h-full bg-gray-100" lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        @vite('resources/css/app.css')
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Styles -->
        <title>Practica 1</title>
    </head>

    <body class="h-full">
        <div class="min-h-full">
            {{-- seccion del menu de opciones --}}
            <nav class="bg-gray-800">
                <div class="mx-auto max-w-7xl py-3">
                <div class="flex h-16 items-center justify-between">
                    <div class="container mx auto flex justify-between items-center">
                        <div class="flex-shrink-0">
                            <h1 class="text-3xl font-bold text-white">Practica 1</h1>
                        </div>
                        <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            @auth
                                <nav class="flex gap-2 items-center text-gray-300">
                                    <p> Autenticado como: {{ auth()->user()->name }}</p>
                                    {{-- agregar seguridad al logout --}}
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" type="submit">Logout</button>
                                    </form>

                                    {{-- Ruta al dashboard --}}
                                    <a class=" text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href="{{ route('dashboard') }}">Dashboard</a>
                                </nav>

                            @endauth

                            {{-- Determinar al usuario no autenticado --}}
                            @guest
                                {{-- Navegacion --}}
                                <div class="hidden md:block">
                                    <div class="ml-10 flex items-baseline space-x-4">
                                        {{-- <a class="font-bold uppercase text-black text-sm" href="/">Devstagram</a> --}}
                                        {{-- <p class=" text-center text-red-900">Usuario no autenticado</p> --}}
                                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href="{{ route('login') }}">Login</a>
                                        <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href="{{ route('register') }}">Register</a>
                                        {{-- <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href="{{ route('dashboard') }}">Dashboard</a> --}}
                                    </div>
                                </div>
                            @endguest
                        </div>
                        </div>
                        {{-- Aplicar helper para verificar si esta autenticado --}}
                    </div>
                </div>
                </div>
            </nav>

            {{-- Contenido para cada una de las vistas --}}
            <main class="container mx-auto mt-10">
                
                <h2 class="font-black text-center text-3xl mb-10">
                    @yield('titulo')
                </h2>
                @yield('contenido')
            </main>
        </div>
        <footer class="bg-gray-800 py-4">
                <div class="container mx-auto px-4 text-gray-300 text-center text-lg" >
                    <p>Copyright &copy; César Aldahir Flores Gámez
                        <span id="date"></span>. all rights reserved {{now()->year}}</p>
                </div>
        </footer>
    </body>

</html>
