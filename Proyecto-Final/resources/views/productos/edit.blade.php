@extends('layouts.app')

@push('styles')
{{-- Estilos dropzone --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" type="text/css">
@endpush

@section('titulo')
   Editar Producto
@endsection

@section('contenido')
<div class="container mx-auto px-4">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    <div class="col-span-1 md:col-span-2">
      <div class="col-span-1 md:col-span-2">

        <form action="{{ route('productos.update_imagen', $producto->id) }}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone" style="border: 4px solid; border-radius: 20px; border-image: linear-gradient(to right, #d77cd7, #3B82F6); border-image-slice: 1;">
          @csrf
          @method('PUT')
        </form>


        <form action="{{ route('productos.update', $producto->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-5">
            <input name="imagen" type="hidden" value="{{$producto->imagen}}" />
            @error('imagen')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
            @enderror
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="categoria_id" class="block mb-2 font-semibold">Categoría:</label>
              <select name="categoria_id" id="categoria_id" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione una categoría">
                <option value="">Seleccione una categoría</option>
                @foreach ($categorias as $categoria)
                  <option value="{{ $categoria->id }}" @if($categoria->id == $producto->categoria_id) selected @endif>{{ $categoria->nombre }}</option>
                @endforeach
              </select>
            </div>

            <div class="w-1/2 ml-2">
              <label for="subcategoria_id" class="block mb-2 font-semibold">Subcategoría:</label>
              <select name="subcategoria_id" id="subcategoria_id" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione una subcategoría">
                <option value="">Seleccione una subcategoría</option>
                @foreach ($subcategorias as $subcategoria)
                    <option value="{{ $subcategoria->id }}" @if($subcategoria->categoria_id == $subcategoria->nombre) selected @endif>{{ $subcategoria->nombre }}</option>
                @endforeach
                {{-- @foreach ($subcategorias as $subcategoria)
                  <option value="{{ $subcategoria->id }}" data-categoria="{{ $subcategoria->categoria_id }}">{{ $subcategoria->nombre }}</option>
                @endforeach --}}
            </select>
            </div>
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="marca_id" class="block mb-2 font-semibold">Marca:</label>
              <select name="marca_id" id="marca_id" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Seleccione una marca">
                <option value="">Seleccione una marca (opcional)</option>
                @foreach ($marcas as $marca)
                    <option value="{{ $marca->id }}" @if($marca->id == $producto->marca_id) selected @endif>{{ $marca->nombre }}</option>
                @endforeach
            </select>
            </div>

            <div class="w-1/2 ml-2">
              <label for="nombre" class="block mb-2 font-semibold">Nombre:</label>
              <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el precio de compra">
            </div>
          </div>

          <div class="mb-4 flex">
            <div class="w-1/2 mr-2">
              <label for="precio_compra" class="block mb-2 font-semibold">Precio de Compra:</label>
              <input type="number" name="precio_compra" id="precio_compra" value="{{ $producto->precio_compra }}" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el precio de compra">
            </div>

            <div class="w-1/2 ml-2">
              <label for="precio_venta" class="block mb-2 font-semibold">Precio de Venta:</label>
              <input type="number" name="precio_venta" id="precio_venta" value="{{ $producto->precio_venta }}" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" step="0.01" min="0" placeholder="Ingrese el precio de venta">
            </div>
          </div>

          <div class="mb-4">
            <label for="unidades_disponibles" class="block mb-2 font-semibold">Unidades Disponibles:</label>
            <input type="number" name="unidades_disponibles" id="unidades_disponibles" value="{{ $producto->unidades_disponibles }}" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" min="0" placeholder="Ingrese las unidades disponibles">
          </div>

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

document.getElementById('categoria_id').addEventListener('change', function() {
        var categoriaId = this.value;
        var subcategoriaSelect = document.getElementById('subcategoria_id');
        var subcategorias = subcategoriaSelect.getElementsByTagName('option');
        
        for (var i = 0; i < subcategorias.length; i++) {
            var subcategoria = subcategorias[i];
            if (subcategoria.dataset.categoria == categoriaId) {
                subcategoria.style.display = '';
            } else {
                subcategoria.style.display = 'none';
            }
        }
    });
</script>
@endpush