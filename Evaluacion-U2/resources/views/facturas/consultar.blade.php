@extends('layouts.app')

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
    {{-- <h1>Consultar Facturas</h1> --}}

    <div class="flex justify-center items-center">
        <div class="w-full md:w-5/12 rounded-lg bg-blue-50 p-6 shadow-xl">
            <h1 class="text-center text-3xl font-bold mb-12 text-blue-500">Consulta tu factura ¡Aqui!</h1>
            
            <form method="POST" action="{{ route('buscar_facturas') }}" class="space-y-4" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <input name="pdf_file" type="hidden" id="pdf_file" value="{{ old('pdf_file') }}" />
                </div>
                <div class="mb-4">
                    <input name="xml_file" type="hidden" id="xml_file" value="{{ old('xml_file') }}" />
                </div>
            
                <div class="mb-4">
                    <label for="razon_social" class="mb-2 block uppercase font-bold">Empresa Emisora:</label>
                    <select id="razon_social" name="razon_social" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('razon_social') border-red-500 @enderror">
                        <option value="">Selecciona una razon social</option>
                        {{-- @foreach ($empresasEmisoras as $empresaEmisora)
                            <option value="{{ $empresaEmisora->id }}">{{ $empresaEmisora->razon_social }}</option>
                        @endforeach --}}
                    </select>
                    @error('razon_social')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nombre" class="mb-2 block uppercase font-bold">Razón Social (Receptor):</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Escribe el nombre de la empresa receptora" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nombre') border-red-500 @enderror" value="{{ old('nombre') }}">
                    @error('nombre')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="rfc" class="mb-2 block uppercase font-bold">RFC (Receptor):</label>
                    <input type="text" id="rfc" name="rfc" placeholder="Escribe el rfc de la empresa receptora" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('rfc') border-red-500 @enderror" value="{{ old('rfc') }}">
                    @error('rfc')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="folio_factura" class="mb-2 block uppercase font-bold">Folio de Factura:</label>
                    <input type="text" id="folio_factura" name="folio_factura" placeholder="Escribe el folio de la factura" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('folio_factura') border-red-500 @enderror" value="{{ old('folio_factura') }}">
                    @error('folio_factura')
                        <p class="text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Registrar" class="bg-blue-500 hover:bg-blue-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>
    </div>
      
@endsection
