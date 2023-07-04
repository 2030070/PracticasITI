@extends('layouts.app')

@section('titulo')
    Listado de Empresas Emisoras
@endsection
@section('nav')
    <nav class="flex justify-center items-center mb-4 bg-blue-500">
        <div class="flex items-center mr-6" title="Dashboard">
            <a href="{{ route('post_index')}}" class="flex items-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#FFFFFF" viewBox="0 0 256 256">
                    <path d="M207.06,80.67A111.24,111.24,0,0,0,128,48h-.4C66.07,48.21,16,99,16,161.13V184a16,16,0,0,0,16,16H224a16,16,0,0,0,16-16V160A111.25,111.25,0,0,0,207.06,80.67ZM224,184H119.71l54.76-75.3a8,8,0,0,0-12.94-9.42L99.92,184H32V161.13c0-3.08.15-6.12.43-9.13H56a8,8,0,0,0,0-16H35.27c10.32-38.86,44-68.24,84.73-71.66V88a8,8,0,0,0,16,0V64.33A96.14,96.14,0,0,1,221,136H200a8,8,0,0,0,0,16h23.67c.21,2.65.33,5.31.33,8Z">
                    </path>
                </svg>
            </a>
        </div>
        <div class="flex items-center ml-6" title="Registrar">
            <a href="{{ route('empresas_emisoras.create')}}" class="flex items-center text-white" >
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#FFFFFF" viewBox="0 0 256 256">
                    <path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-40-64a8,8,0,0,1-8,8H136v16a8,8,0,0,1-16,0V160H104a8,8,0,0,1,0-16h16V128a8,8,0,0,1,16,0v16h16A8,8,0,0,1,160,152Z">
                    </path>
                </svg>
            </a>
        </div>
    </nav>
@endsection


@section('contenido')
    <div class="my-4 flex justify-end space-x-2">
        <button onclick="exportToPDF('empresas_emisoras')" class="inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-red-600 hover:bg-red-700 transition-colors">
            Exportar a PDF
        </button>

        <button onclick="exportToExcel('empresas_emisoras')" class="inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-green-600 hover:bg-green-700 transition-colors">
            Exportar a Excel
        </button>
    </div>
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <table class=" table-auto mt-4 w-full border-2 border-blue-400 rounded-lg border-collapse" id="maintable">
            <thead class="bg-blue-400">
                <tr>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">ID</th>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">Razón Social</th>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">Email</th>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">RFC</th>
                </tr>
            </thead>
            @auth
            <tbody>
                @if ($empresaEmisora->count() > 0)
                    @foreach ($empresaEmisora as $empresa)
                        <tr>
                            <td class="py-2 px-4 border-2 border-blue-400 text-right">{{ $empresa->id }}</td>
                            <td class="py-2 px-4 border-2 border-blue-400">{{ $empresa->razon_social }}</td>
                            <td class="py-2 px-4 border-2 border-blue-400">{{ $empresa->correo_contacto }}</td>
                            <td class="py-2 px-4 border-2 border-blue-400">{{ $empresa->rfc_emisor }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="py-2 px-4 font-bold">No hay empresas emisoras registradas.</td>
                    </tr>
                @endif
            </tbody>
            @endauth

        </table>
    </div>

@endsection


