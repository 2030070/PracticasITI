@extends('layouts.app')

@section('titulo')
   Dashboard
@endsection

@push('styles')
    <style>
        /* Estilos adicionales */
        .box {
            transition: transform 0.3s;
            color: #ffffff;
            background-color: #4085cf;
        }
        .box:hover {
            transform: scale(1.1);
        }
    </style>
@endpush

@section('contenido')
<body class="m-0 font-sans text-base antialiased font-normal leading-default text-slate-800 h-full">
    @auth
        <div class="grid grid-cols-4 gap-4 justify-center items-center">
            <!-- Tabla de datos -->
            <div class="bg-white rounded-lg p-4 hover-float box col-span-1">
                <h2 class="text-lg font-semibold mb-4">Tabla de datos</h2>
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Nombre</th>
                            <th class="text-left">Edad</th>
                            <th class="text-left">Ciudad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>John Doe</td>
                            <td>30</td>
                            <td>New York</td>
                        </tr>
                        <tr>
                            <td>Jane Smith</td>
                            <td>25</td>
                            <td>London</td>
                        </tr>
                        <!-- Agrega más filas de ejemplo aquí -->
                    </tbody>
                </table>
            </div>

            <!-- Indicador numérico -->
            <div class="bg-white rounded-lg p-4 hover-float box col-span-1">
                <h2 class="text-lg font-semibold mb-2">Ventas Mensuales</h2>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="h-6 w-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"></path>
                    </svg>
                    <span class="text-2xl font-bold">250</span>
                </div>
            </div>

            <!-- Gráfica -->
            <div class="bg-white rounded-lg p-4 hover-float box col-span-2">
                <h2 class="text-lg font-semibold mb-4">Gráfica de ventas</h2>
                <div class="text-center">
                    
                    <!-- Aquí puedes agregar el código para mostrar una gráfica usando una librería como Chart.js o ApexCharts -->
                </div>
            </div>
        </div>
    @endauth
</body>
@endsection
