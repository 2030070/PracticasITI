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
            @yield('sliderbar')
            @yield('header')
            <main class="container mx-auto mt-10">
                @yield('contenido')
            </main>
        </div>
        {{-- Diseño del footer es decir el pie de pagina --}}
        <footer>
            <div class="container mx-auto px-4 text-lg text-center py-4">
                <p class="text-blue-500">Copyright &copy;
                    <span id="date"></span>. all rights reserved {{now()->year}}</p>
            </div>
        </footer>
    </body>
</html>
