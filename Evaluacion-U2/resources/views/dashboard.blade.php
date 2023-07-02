@extends('layouts.app')

@section('titulo')
   Dashboard
@endsection

@push('styles')
    {{-- Contenido para los estilos propios o asignados respectivamente --}}
    <style>
        /* Estilos para la simulación de flotación */
        .hover-float:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        /* Estilos para el efecto de acercamiento */
        .zoom-in {
            transform: scale(1);
            transition: transform 0.3s;
        }
        .zoom-in:hover {
            transform: scale(1.1);
        }
    </style>
@endpush

@section('contenido')
    @auth
        <div class="grid grid-cols-2 gap-6 justify-center items-center">
            <a href="{{ route('empresas_emisoras.create') }}" class="bg-blue-100 rounded-lg p-4 hover-float zoom-in flex flex-col justify-center items-center h-40 w-2/4" style="background-image: url('ruta_de_la_imagen')">

                {{-- Contenido del primer recuadro --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="125" height="125" fill="#000000" viewBox="0 0 256 256">
                    <path d="M83.19,174.4a8,8,0,0,0,11.21-1.6,52,52,0,0,1,83.2,0,8,8,0,1,0,12.8-9.6A67.88,67.88,0,0,0,163,141.51a40,40,0,1,0-53.94,0A67.88,67.88,0,0,0,81.6,163.2,8,8,0,0,0,83.19,174.4ZM112,112a24,24,0,1,1,24,24A24,24,0,0,1,112,112Zm96-88H64A16,16,0,0,0,48,40V64H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v24a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V40A16,16,0,0,0,208,24Zm0,192H64V40H208Z"></path>
                </svg>
                <div class="text-center">
                    <h2 class="text-lg font-semibold">Registrar Empresas Emisoras</h2>
                </div>
            </a>
            
            

            <a href="{{ route('empresas_receptoras.create') }}" class="bg-blue-100 rounded-lg p-4 hover-float zoom-in flex flex-col justify-center items-center h-40 w-2/4" style="background-image: url('ruta_de_la_imagen')">
                {{-- Contenido del primer recuadro --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="125" height="125" fill="#000000" viewBox="0 0 256 256">
                    <path d="M83.19,174.4a8,8,0,0,0,11.21-1.6,52,52,0,0,1,83.2,0,8,8,0,1,0,12.8-9.6A67.88,67.88,0,0,0,163,141.51a40,40,0,1,0-53.94,0A67.88,67.88,0,0,0,81.6,163.2,8,8,0,0,0,83.19,174.4ZM112,112a24,24,0,1,1,24,24A24,24,0,0,1,112,112Zm96-88H64A16,16,0,0,0,48,40V64H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v40H32a8,8,0,0,0,0,16H48v24a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V40A16,16,0,0,0,208,24Zm0,192H64V40H208Z">
                </path></svg>
                <div class="text-center">
                    <h2 class="text-lg font-semibold">Registrar Empresas Receptora</h2>
                </div>
            </a>

            <a href="#" class="bg-blue-100 rounded-lg p-4 hover-float zoom-in flex flex-col justify-center items-center h-40 w-2/4" style="background-image: url('ruta_de_la_imagen')">
                {{-- Contenido del primer recuadro --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="125" height="125" fill="#000000" viewBox="0 0 256 256">
                <path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-40-64a8,8,0,0,1-8,8H136v16a8,8,0,0,1-16,0V160H104a8,8,0,0,1,0-16h16V128a8,8,0,0,1,16,0v16h16A8,8,0,0,1,160,152Z">
                    </path></svg>
                <div class="text-center">
                    <h2 class="text-lg font-semibold">Registrar Facturas</h2>
                </div>
            </a>

            <a href="#" class="bg-blue-100 rounded-lg p-4 hover-float zoom-in flex flex-col justify-center items-center h-40 w-2/4" style="background-image: url('ruta_de_la_imagen')">
                {{-- Contenido del primer recuadro --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="125" height="125" fill="#000000" viewBox="0 0 256 256">
                    <path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-45.54-48.85a36.05,36.05,0,1,0-11.31,11.31l11.19,11.2a8,8,0,0,0,11.32-11.32ZM104,148a20,20,0,1,1,20,20A20,20,0,0,1,104,148Z">
                    </path></svg>
                <div class="text-center">
                    <h2 class="text-lg font-semibold">Busqueda de Facturas</h2>
                </div>
            </a>
        </div>
    @endauth
        
@endsection


