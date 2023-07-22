@extends('layouts.app')

@push('styles')
    {{-- Estilos dropzone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" type="text/css">
@endpush

@section('titulo')
   Editar Usuario
@endsection

@section('contenido')

<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">

            <form action="{{ route('usuarios.update_imagen', $usuario->id) }}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone" style="border: 4px solid; border-radius: 20px; border-image: linear-gradient(to right, #d77cd7, #3B82F6); border-image-slice: 1;">
                @csrf
                @method('PUT')
            </form>
            
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    
                    <div class="mb-5">
                        <input name="imagen" type="hidden" value="{{$usuario->imagen}}" />
                        @error('imagen')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="nombre" class="block mb-2 font-semibold">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" value="{{ $usuario->nombre }}" placeholder="Ingrese el nombre del cliente" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    </div>
                  
                    <div class="mb-4">
                        <label for="apellidos" class="block mb-2 font-semibold">Apellidos:</label>
                        <input type="text" name="apellidos" id="apellidos" value="{{ $usuario->apellidos }}" placeholder="Ingrese los apellidos" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    </div>
                    
                    <div class="mb-4">
                        <label for="usuario" class="block mb-2 font-semibold">Nombre de usuario:</label>
                        <input type="text" name="usuario" id="usuario" value="{{ $usuario->usuario }}" placeholder="Ingrese el nombre de usuario" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block mb-2 font-semibold">Password:</label>
                        <input type="text" name="password" id="password"  value="{{ $usuario->password }}" placeholder="Ingrese el password" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    </div>

                    <div class="mb-4">
                        <label for="telefono" class="block mb-2 font-semibold">Teléfono:</label>
                        <input type="text" name="telefono" id="telefono" value="{{ $usuario->telefono }}" placeholder="Ingrese el número de teléfono" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block mb-2 font-semibold">Correo:</label>
                        <input type="email" name="email" id="email" value="{{ $usuario->email }}" placeholder="Ingrese el correo electrónico" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    </div>

                    <label for="rol" class="block mb-2 font-semibold">Rol:</label>
                    <select id="rol" name="rol" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione una rol">
                        <option value="select" selected>Select</option>
                        <option value="owner">Owner</option>
                    </select>

                    <input type="hidden" name="creado_por" value="{{ Auth::user()->name }}">

                    <div>
                        <input type="submit" value="Actualizar" class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                    </div>
                </form>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
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
  init: function() {
    const dropzoneInstance = this;

    // Verificar si hay una imagen existente
    const imagenActual = document.querySelector('[name="imagen"]').value.trim();
    if (imagenActual) {
      const imagenPublicada = {
        size: 1234,
        name: imagenActual
      };

      // Mostrar la imagen existente
      dropzoneInstance.emit("addedfile", imagenPublicada);
      dropzoneInstance.emit("thumbnail", imagenPublicada, '/uploads/' + imagenPublicada.name);
      dropzoneInstance.files.push(imagenPublicada);
      imagenPublicada.previewElement.classList.add("dz-success", "dz-complete");
    }

    // Listener para reemplazar la imagen existente
    dropzoneInstance.on("addedfile", function(file) {
      // Eliminar la imagen existente
      if (this.files.length > 1) {
        dropzoneInstance.removeFile(this.files[0]);
      }
    });

    // Listener para actualizar el valor del campo oculto al subir una nueva imagen
    dropzoneInstance.on("success", function(file, response) {
      document.querySelector('[name="imagen"]').value = response.imagen;
    });

    // Listener para limpiar el valor del campo oculto al eliminar la imagen
    dropzoneInstance.on("removedfile", function(file) {
      document.querySelector('[name="imagen"]').value = "";
    });
  },
  error: function(file, message) {
    console.log(message);
  }
});

</script>
@endpush
