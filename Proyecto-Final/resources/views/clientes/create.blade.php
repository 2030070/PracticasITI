@extends('layouts.app')

@push('styles')
    {{-- Estilos dropzone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" type="text/css">
@endpush

@section('titulo')
   Registrar Cliente
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone" style="border: 4px solid; border-radius: 20px; border-image: linear-gradient(to right, #d77cd7, #3B82F6); border-image-slice: 1;">
                    @csrf
                </form>

                <form action="{{ route('clientes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-5">
                        <input name="imagen" type="hidden" value="{{ old('imagen') }}" />
                        @error('imagen')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 flex">
                        <div class="w-1/2 mr-2">
                            <label for="nombre" class="block mb-2 font-semibold">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el nombre del cliente" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                            @error('nombre')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div class="w-1/2 ml-2">
                            <label for="empresa" class="block mb-2 font-semibold">Empresa:</label>
                            <input type="text" name="empresa" id="empresa" value="{{ old('empresa') }}" placeholder="Ingrese el nombre de la empresa" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                            @error('empresa')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4 flex">
                        <div class="w-1/2 mr-2">
                            <label for="codigo" class="block mb-2 font-semibold">Código:</label>
                            <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" placeholder="Ingrese el código" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                            @error('codigo')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-1/2 ml-2">
                            <label for="telefono" class="block mb-2 font-semibold">Teléfono:</label>
                            <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" placeholder="Ingrese el número de teléfono" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                            @error('telefono')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 flex">
                        <div class="w-1/2 mr-2">
                            <label for="correo" class="block mb-2 font-semibold">Correo:</label>
                            <input type="email" name="correo" id="correo" value="{{ old('correo') }}" placeholder="Ingrese el correo electrónico" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                            @error('correo')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-1/2 ml-2">
                            <label for="pais" class="block mb-2 font-semibold">Pais:</label>
                            <select name="pais" id="pais" value="{{ old('pais') }}" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white  bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                <option value="">Seleccione un país</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('pais')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 flex">
                        <div class="w-1/2 mr-2">
                            <label for="estado" class="block mb-2 font-semibold">Estado:</label>
                        <select name="estado" id="estado" value="{{ old('estado') }}" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                            <option value="">Seleccione un estado</option>
                            @foreach($states as $state)
                                <option value="{{ $state->state_name }}" data-country="{{ $state->countryid }}">{{ $state->state_name }}</option>
                            @endforeach
                        </select>
                        @error('estado')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                        </div>

                        <div class="w-1/2 ml-2">
                            <label for="ciudad" class="block mb-2 font-semibold">Ciudad:</label>
                        <input type="text" name="ciudad" id="ciudad" value="{{ old('ciudad') }}"  placeholder="Ingrese la ciudad" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        @error('ciudad')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror  
                        </div>
                    </div>

                    <div>
                        <input type="submit" value="Registrar" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral --> --}}
        <div class="col-span-1 md:col-span-1">
            <div class="sticky top-0 h-screen p-4 rounded-lg">
              <div class="flex flex-col items-center justify-center gap-4 bg-blue-500/13 rounded-lg p-4">
                <a href="{{ route('clientes.show') }}">
                  <img src="{{ asset('img/clientes.png') }}" alt="Imagen" class="flex flex-col justify-center w-48 h-48 rounded-sm">
                  <h3 class="text-blue-700 text-center">Ver Clientes</h3>
                </a> 
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>

<script>
Dropzone.autoDiscover = false;
const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: "Sube tu imagen aquí",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {
                size: 1234,
                name: document.querySelector('[name="imagen"]').value
            };
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, '/uploads/' + imagenPublicada.name);
            imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
        }
    },
    success: function (file, response) {
        document.querySelector('[name="imagen"]').value = response.imagen;
    },
    error: function (file, message) {
        console.log(message);
    },
    removedfile: function () {
        document.querySelector('[name="imagen"]').value = "";
    }
});
</script>
@endpush
