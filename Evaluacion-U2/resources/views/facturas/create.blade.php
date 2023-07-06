@extends('layouts.app')

@section('titulo')
    Registro de Facturas
@endsection

@push('styles')
    {{-- Estilos de dropzone css --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

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
            <a href="{{ route('facturas.index')}}" class="flex items-center text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="#FFFFFF" viewBox="0 0 256 256">
                    <path d="M32,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H40A8,8,0,0,1,32,64Zm8,72h72a8,8,0,0,0,0-16H40a8,8,0,0,0,0,16Zm88,48H40a8,8,0,0,0,0,16h88a8,8,0,0,0,0-16Zm109.66,13.66a8,8,0,0,1-11.32,0L206,177.36A40,40,0,1,1,217.36,166l20.3,20.3A8,8,0,0,1,237.66,197.66ZM184,168a24,24,0,1,0-24-24A24,24,0,0,0,184,168Z">
                    </path>
                </svg>
            </a>
        </div>
    </nav>
@endsection

@section('contenido')
    @auth
        <div class="flex justify-center items-center">
            <div class="w-full md:w-5/12 rounded-lg bg-blue-50 p-6 shadow-xl">
                <h1 class="text-center text-3xl font-bold mb-12 text-blue-500">Formulario de Registro de Facturas</h1>
                <div class="mb-10">
                    <div class="mb-4">
                        <label for="pdf_file" class="mb-2 block uppercase font-bold">Archivo PDF:</label>

                        @error('pdf_file')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                        @enderror
                    </div>
                    <form action="{{route('archivos.store')}}" method="POST" enctype="multipart/form-data" id="dropzonePDF" class="dropzone border-dashed border-2 w-full h-50 rounded
                        flex flex-col justify-center items-center mb-5" style="border: 4px solid; border-radius: 20px; border-image: linear-gradient(to right, #ff00ff, #00ffff); border-image-slice: 1;">
                            @csrf
                    </form>
                    
                </div>
                <div class="mb-10">
                    <div class="mb-4">
                        <label for="xml_file" class="mb-2 block uppercase font-bold">Archivo XML:</label>
                        @error('xml_file')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }} </p>
                        @enderror
                    </div>

                    <form action="{{route('archivos2.store')}}" method="POST" enctype="multipart/form-data" id="dropzoneXML" class="dropzone border-dashed border-2 w-full h-50 rounded
                        flex flex-col justify-center items-center mb-5" style="border: 4px solid; border-radius: 20px; border-image: linear-gradient(to right, #ff00ff, #00ffff); border-image-slice: 1;">
                            @csrf
                    </form>
                </div>
                


                
                <form method="POST" action="{{ route('facturas.store') }}" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <input name="pdf_file" type="hidden" id="pdf_file" value="{{ old('pdf_file') }}" />
                    </div>
                    <div class="mb-4">
                        <input name="xml_file" type="hidden" id="xml_file" value="{{ old('xml_file') }}" />
                    </div>
                
                    <div class="mb-4">
                        <label for="empresa_emisora" class="mb-2 block uppercase font-bold">Empresa Emisora:</label>
                        <select id="empresa_emisora" name="empresa_emisora" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('empresa_emisora') border-red-500 @enderror">
                            <option value="">Selecciona una empresa emisora</option>
                            @foreach ($empresasEmisoras as $empresaEmisora)
                                <option value="{{ $empresaEmisora->id }}">{{ $empresaEmisora->razon_social }}</option>
                            @endforeach
                        </select>
                        @error('empresa_emisora')
                            <p class="text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="empresa_receptora" class="mb-2 block uppercase font-bold">Empresa Receptora:</label>
                        <select id="empresa_receptora" name="empresa_receptora" required class="w-full p-2 pl-8 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('empresa_receptora') border-red-500 @enderror">
                            <option value="">Selecciona una empresa receptora</option>
                            @foreach($empresasReceptoras as $empresaReceptora)
                                <option value="{{ $empresaReceptora->id }}">{{ $empresaReceptora->nombre }}</option>
                            @endforeach
                        </select>
                        @error('empresa_receptora')
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
    @endauth
@endsection

