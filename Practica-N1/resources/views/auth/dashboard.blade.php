@extends('layouts.app')
{{-- @vite('resources/css/app.css') --}}
@section('contenido')
<main>
    <div class="flex">
        <!-- Menú lateral izquierdo -->
        <div class="sidebar bg-gray-800 w-64 fixed top-20 h-full z-10 inset-y-0 left-0 overflow-y-auto transition-transform duration-300 ease-out transform translate-x-0">
            <ul class="py-4">
                {{-- Link a dashboard --}}
                <li>
                    <a href="{{ route('dashboard') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a>
                </li>
                {{-- Link a usuarios --}}
                <li>
                    <a href="{{ route('users') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"><i class="fas fa-users mr-2"></i>Ver Usuarios</a>
                </li>
                {{-- Link para mostrar los productos --}}
                <li>
                    <a href="{{ route('products') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"><i class="fas fa-box-open mr-2"></i>Ver Productos</a>
                </li>
                {{-- Link para ir al formulario de agregar productos --}}
                <li>
                    <a href="{{ route('register_product') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"><i class="fa fa-plus-circle fa-fw"></i>Registrar Producto</a>
                </li>
                {{-- Link para ir a la tabla de productos y eliminar algún producto --}}
                <li>
                    <a href="{{ route('delete_product') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium"><i class="fa fa-trash fa-fw"></i>Eliminar Producto</a>
                </li>
            </ul>
        </div>

        <button id="sidebar-toggle" class="fixed top-10 left-0 z-20 bg-gray-800 text-white px-4 py-2 m-4 rounded-md">
            <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path
                    d="M4 6H20M4 12H20M4 18H11"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>
        </button>
        
        {{-- Agregamos seguridad para que si no está logueado no pueda ver las tablas ni el formulario --}}
        @auth
        {{-- Si está autenticado --}}

        <!-- Contenido de la página muestra tabla si es que hay -->
        @yield('tables')

        <!-- Contenido de la página muestra formulario si es que hay -->
        @yield('form')
        @else
        {{-- Si no está autenticado --}}

        {{-- Mensaje para pedir que se logue o registre --}}
        <div class="flex-1">
            <div class="p-6">
                <h1 class="text-2xl text-red-700 font-bold">Por favor, inicia sesión o regístrate</h1>
            </div>
        </div>
        @endauth
    </div>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const sidebarToggle = document.querySelector('#sidebar-toggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>

    <style>
        .translate-x-0 {
            transform: translateX(0);
        }

        .-translate-x-full {
            transform: translateX(-100%);
        }
    </style>
</main>
    @endsection


