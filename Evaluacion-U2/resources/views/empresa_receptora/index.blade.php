@extends('layouts.app')

@section('titulo')
    Listado de Empresas Receptora
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
            <a href="{{ route('empresas_receptoras.create')}}" class="flex items-center text-white" >
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#FFFFFF" viewBox="0 0 256 256">
                    <path d="M213.66,82.34l-56-56A8,8,0,0,0,152,24H56A16,16,0,0,0,40,40V216a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V88A8,8,0,0,0,213.66,82.34ZM160,51.31,188.69,80H160ZM200,216H56V40h88V88a8,8,0,0,0,8,8h48V216Zm-40-64a8,8,0,0,1-8,8H136v16a8,8,0,0,1-16,0V160H104a8,8,0,0,1,0-16h16V128a8,8,0,0,1,16,0v16h16A8,8,0,0,1,160,152Z">
                    </path>
                </svg>
            </a>
        </div>
    </nav>
@endsection


@section('contenido')
<!--botones de exportar que llaman al js de app-->
    <div class="my-4 flex justify-end space-x-2">
        @auth
        <button onclick="exportToPDF('empresas_receptoras')" class="inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-blue-500 hover:bg-blue-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffffff" viewBox="0 0 256 256">
                <path d="M224,152a8,8,0,0,1-8,8H192v16h16a8,8,0,0,1,0,16H192v16a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8h32A8,8,0,0,1,224,152ZM92,172a28,28,0,0,1-28,28H56v8a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8H64A28
                ,28,0,0,1,92,172Zm-16,0a12,12,0,0,0-12-12H56v24h8A12,12,0,0,0,76,172Zm88,8a36,36,0,0,1-36,36H112a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8h16A36,36,0,0,1,164,180Zm-16,0a20,20,0,0,0-20-20h-8v40h8A20,
                20,0,0,0,148,180ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,0,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.69L160,51.31Z"></path>
            </svg>
        </button>

        <button onclick="exportToExcel('empresas_receptoras')" class="inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-blue-500 hover:bg-blue-700 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffffff" viewBox="0 0 256 256"><path d="M156,208a8,8,0,0,1-8,8H120a8,8,0,0,1-8-8V152a8,8,0,0,1,16,0v48h20A8,8,0,0,1,156,208ZM92.65,
                145.49a8,8,0,0,0-11.16,1.86L68,166.24,54.51,147.35a8,8,0,1,0-13,9.3L58.17,180,41.49,203.35a8,8,0,0,0,13,9.3L68,193.76l13.49,18.89a8,8,0,0,0,13-9.3L77.83,180l16.68-23.35A8,8,0,0,0,92.65,145.49Zm98.94,
                25.82c-4-1.16-8.14-2.35-10.45-3.84-1.25-.82-1.23-1-1.12-1.9a4.54,4.54,0,0,1,2-3.67c4.6-3.12,15.34-1.72,19.82-.56a8,8,0,0,0,4.07-15.48c-2.11-.55-21-5.22-32.83,2.76a20.58,20.58,0,0,0-8.95,14.95c-2,15.88,
                13.65,20.41,23,23.11,12.06,3.49,13.12,4.92,12.78,7.59-.31,2.41-1.26,3.33-2.15,3.93-4.6,3.06-15.16,1.55-19.54.35A8,8,0,0,0,173.93,214a60.63,60.63,0,0,0,15.19,2c5.82,0,12.3-1,17.49-4.46a20.81,20.81,0,0,0,
                9.18-15.23C218,179,201.48,174.17,191.59,171.31ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,1,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.68L160,51.31Z"></path>
            </svg>
        </button>     
        @endauth
        
    </div>
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <table class=" table-auto mt-4 w-full border-2 border-blue-400 rounded-lg border-collapse" id="maintable">
            <thead class="bg-blue-400">
                <tr>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">ID</th>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">Nombre</th>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">Dirección</th>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">RFC</th>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">Contacto</th>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">Email</th>
                    <th class="py-2 text-lg font-bold text-white border-2 border-blue-400">Acciones</th>

                </tr>
            </thead>
            @auth
            <tbody>
                @if ($empresaReceptora->count() > 0)
                    @foreach ($empresaReceptora as $empresa)
                        <tr>
                            <td class="py-2 px-4 border-2 border-blue-400 text-right">{{ $empresa->id }}</td>
                            <td class="py-2 px-4 border-2 border-blue-400">{{ $empresa->nombre }}</td>
                            <td class="py-2 px-4 border-2 border-blue-400">{{ $empresa->direccion }}</td>
                            <td class="py-2 px-4 border-2 border-blue-400">{{ $empresa->rfc }}</td>
                            <td class="py-2 px-4 border-2 border-blue-400">{{ $empresa->contacto }}</td>
                            <td class="py-2 px-4 border-2 border-blue-400">{{ $empresa->email }}</td>
                            <td class="py-2 px-4 border-2 border-blue-400">
                                <form action="{{ route('empresas_receptoras.destroy', $empresa->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
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
    <div class="mt-4">
        {{ $empresaReceptora->links() }}
    </div
@endsection


