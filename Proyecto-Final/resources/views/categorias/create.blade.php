@extends('layouts.app')

@section('titulo')
   Registrar Categoría
@endsection

@push('styles')
    {{-- Estilos dropzone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" type="text/css">
@endpush

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">
            <div class="">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone" style="border: 4px solid; border-radius: 20px; border-image: linear-gradient(to right, #d77cd7, #3B82F6); border-image-slice: 1;">
                        @csrf
                    </form>  
                    <form action="{{ route('categorias.store') }}" method="POST">
                        @csrf

                        <div class="mb-5">
                            <input name="imagen" type="hidden" value="{{ old('imagen') }}" />
                            @error('imagen')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4 flex">
                            <div class="w-1/3 mr-2">
                                <label for="codigo" class="block mb-2 font-semibold">Código:</label>
                                <input type="text" name="codigo" id="codigo" value="{{ old('codigo') }}" placeholder="Ingrese el código" required
                                    class="focus:shadow-primary-outline dark:text-white/80 
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none">
                                @error('codigo')
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="w-2/3 ml-2">
                              <label for="nombre" class="block mb-2 font-semibold">Nombre:</label>
                              <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ingrese el nombre de la categoria" required
                                  class="focus:shadow-primary-outline dark:text-white/80 
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none">
                                @error('nombre')
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                                @enderror
                            </div>
                          
                        </div>
                        <input type="hidden" name="creado_por" value="{{ Auth::user()->name }}">


                        <div class="mb-4">
                            <label for="descripcion" class="block mb-2 font-semibold">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" placeholder="Ingrese la descripción" required
                                class="focus:shadow-primary-outline dark:text-white/80 
                                text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                focus:border-fuchsia-300 focus:outline-none">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <input type="submit" value="Registrar"
                                class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 
                                hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md 
                                bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral --> --}}
        <div class="col-span-1 md:col-span-1">
            <div class="sticky top-0 h-screen p-4 rounded-lg">
              <div class="flex flex-col items-center justify-center gap-4 bg-blue-500/13 rounded-lg p-4">
                <a href="{{ route('categorias.show') }}">
                  <img src="{{ asset('img/categorias.png') }}" alt="Imagen" class="flex flex-col justify-center w-48 h-48 rounded-sm">
                  <h3 class="text-blue-700 text-center">Ver Categorias</h3>
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

// import Dropzone from "dropzone";
Dropzone.autoDiscover = false;
const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: "Sube tu imagen aqui",
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMUltiple: false,
    //trabajando con imagen en el contenedor de dropzone
    init: function () {
        if (document.querySelector('[name="imagen"]').value.trim()) {
            const imagenPublicada = {};
            imagenPublicada.size = 1234
            imagenPublicada.name =
                document.querySelector('[name="imagen"]').value;
            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, '/uploads/{$imagenPublicada.name}')
            imagenPublicada.previewElement.classList.add(
                "dz-success",
                "dz-complete",
            );
        };
    }
});

//evento de envio de correo correcto 
dropzone.on('success', function (file, response) {
    // console.log(response)
    document.querySelector('[name="imagen"]').value = response.imagen;
});
//Envio cuando hay error
dropzone.on('error', function (file, message) {
    console.log(message)
});
//remover un archivo
dropzone.on('removedfile', function () {
    // console.log('El archivo se elimino')
    document.querySelector('[name="imagen"]').value="";
});
</script>
@endpush