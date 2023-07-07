{{-- Se tiene el contenido principal para la estructura de layouts.app.blade.php --}}
@extends('layouts.app')

{{-- seccion para un encabezado donde se centran dos botones para poder ver y navegar por el sitio web el cual 
    se les asigna iconos representativos --}}
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
</nav>
@endsection

@section('contenido')
    <div class="flex justify-center items-center">
        <div class="w-full md:w-5/12 rounded-lg bg-blue-50 p-6 shadow-xl">
            <h1 class="text-center text-3xl font-bold mb-12 text-blue-500">Consulta tu factura aquí</h1>
            
            <form method="POST" action="{{ route('buscar_facturas') }}" class="space-y-4" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="razon_social" class="block font-bold mb-2">Razón Social (Emisor):</label>
                    <select id="razon_social" required name="razon_social" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('razon_social') border-red-500 @enderror">
                        <option value="">Selecciona una razón social</option>
                        @foreach ($empresasEmisoras as $empresaEmisora)
                            <option value="{{ $empresaEmisora->id }}">{{ $empresaEmisora->razon_social }}</option>
                        @endforeach
                    </select>
                    @error('razon_social')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="rfc" required class="block font-bold mb-2">RFC (Receptor):</label>
                    <select id="rfc" required name="rfc" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('rfc') border-red-500 @enderror">
                        <option value="">Selecciona un RFC</option>
                        @foreach ($empresasReceptoras as $empresaReceptora)
                            <option value="{{ $empresaReceptora->id }}">{{ $empresaReceptora->rfc }}</option>
                        @endforeach
                    </select>
                    @error('rfc')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="nombre" required class="block font-bold mb-2">Nombre (Receptor):</label>
                    <select id="nombre" required name="nombre" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nombre') border-red-500 @enderror">
                        <option value="">Selecciona un nombre</option>
                        @foreach ($empresasReceptoras as $empresaReceptora)
                            <option value="{{ $empresaReceptora->id }}">{{ $empresaReceptora->nombre }}</option>
                        @endforeach
                    </select>
                    @error('nombre')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
        
                <div class="mb-4">
                    <label for="folio" class="block font-bold mb-2">Folio:</label>
                    <input type="text" id="folio" name="folio" class="w-full p-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('folio') border-red-500 @enderror">
                    @error('folio')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-800 transition-colors cursor-pointer text-white font-bold py-2 px-4 rounded">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Muestra la tabla de facturas si se encontraron resultados --}}
    @if (session('success'))
      
<div class="my-10 py-2 overflow-x-auto sm:-mx-6 justify-center sm:px-6 lg:-mx-8 pr-10 lg:px-8">
    <h1 class="text-black text-sm lg:text-2xl text-center font-bold">Facturas encontradas</h1>
    <button onclick="exportToPDF('facturas')" class="inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-blue-500 hover:bg-blue-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffffff" viewBox="0 0 256 256">
            <path d="M224,152a8,8,0,0,1-8,8H192v16h16a8,8,0,0,1,0,16H192v16a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8h32A8,8,0,0,1,224,152ZM92,172a28,28,0,0,1-28,28H56v8a8,8,0,0,1-16,0V152a8,8,0,0,1,8-8H64A28
            ,28,0,0,1,92,172Zm-16,0a12,12,0,0,0-12-12H56v24h8A12,12,0,0,0,76,172Zm88,8a36,36,0,0,1-36,36H112a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8h16A36,36,0,0,1,164,180Zm-16,0a20,20,0,0,0-20-20h-8v40h8A20,
            20,0,0,0,148,180ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,0,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.69L160,51.31Z"></path>
        </svg>
    </button>

    <button onclick="exportToExcel('facturas')" class="inline-block px-2 py-1 rounded-lg font-bold text-sm text-white bg-blue-500 hover:bg-blue-700 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#ffffff" viewBox="0 0 256 256"><path d="M156,208a8,8,0,0,1-8,8H120a8,8,0,0,1-8-8V152a8,8,0,0,1,16,0v48h20A8,8,0,0,1,156,208ZM92.65,
            145.49a8,8,0,0,0-11.16,1.86L68,166.24,54.51,147.35a8,8,0,1,0-13,9.3L58.17,180,41.49,203.35a8,8,0,0,0,13,9.3L68,193.76l13.49,18.89a8,8,0,0,0,13-9.3L77.83,180l16.68-23.35A8,8,0,0,0,92.65,145.49Zm98.94,
            25.82c-4-1.16-8.14-2.35-10.45-3.84-1.25-.82-1.23-1-1.12-1.9a4.54,4.54,0,0,1,2-3.67c4.6-3.12,15.34-1.72,19.82-.56a8,8,0,0,0,4.07-15.48c-2.11-.55-21-5.22-32.83,2.76a20.58,20.58,0,0,0-8.95,14.95c-2,15.88,
            13.65,20.41,23,23.11,12.06,3.49,13.12,4.92,12.78,7.59-.31,2.41-1.26,3.33-2.15,3.93-4.6,3.06-15.16,1.55-19.54.35A8,8,0,0,0,173.93,214a60.63,60.63,0,0,0,15.19,2c5.82,0,12.3-1,17.49-4.46a20.81,20.81,0,0,0,
            9.18-15.23C218,179,201.48,174.17,191.59,171.31ZM40,112V40A16,16,0,0,1,56,24h96a8,8,0,0,1,5.66,2.34l56,56A8,8,0,0,1,216,88v24a8,8,0,1,1-16,0V96H152a8,8,0,0,1-8-8V40H56v72a8,8,0,0,1-16,0ZM160,80h28.68L160,51.31Z"></path>
        </svg>
    </button>    
    <div class="align-middle inline-block min-w-full shadow overflow-hidden bg-white shadow-dashboard px-8 pt-3 rounded-bl-lg rounded-br-lg my-4">
        <table class="min-w-full" id="maintable">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b-2 border-blue-500 text-center leading-4 text-bold  tracking-wider">ID</th>
                    <th class="px-6 py-3 border-b-2 border-blue-500 text-center leading-4 text-bold tracking-wider">Empresa Emisora</th>
                    <th class="px-6 py-3 border-b-2 border-blue-500 text-center leading-4 text-bold tracking-wider">Empresa Receptora</th>
                    <th class="px-6 py-3 border-b-2 border-blue-500 text-center leading-4 text-bold tracking-wider">Folio de Factura</th>
                    <th class="px-6 py-3 border-b-2 border-blue-500 text-center leading-4 text-bold tracking-wider">Archivo PDF</th>
                    <th class="px-6 py-3 border-b-2 border-blue-500 text-center leading-4 text-bold tracking-wider">Archivo XML</th>
                    <th class="px-6 py-3 border-b-2 border-blue-500 text-center leading-4 text-bold tracking-wider">Fecha de Creación</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($facturas as $factura)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500">
                            <div class="text-sm leading-5 text-gray-800 text-center">{{ $factura->id }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500  text-sm leading-5 text-center">{{ $factura->empresaEmisora->razon_social }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500  text-sm leading-5 text-center">{{ $factura->empresaReceptora }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500  text-sm leading-5 text-center">{{ $factura->folio_factura }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500  text-sm leading-5 text-center">{{ $factura->pdf_file }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500  text-sm leading-5 text-center">{{ $factura->xml_file }}</td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-blue-500  text-sm leading-5 text-center">{{ $factura->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@elseif (session('error'))
<p class="mt-8 text-center">No se encontraron resultados.</p>
@endif
    
@endsection
