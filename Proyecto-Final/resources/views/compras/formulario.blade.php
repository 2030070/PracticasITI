@extends('layouts.app')

@push('styles')
    {{-- Estilos dropzone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css" type="text/css">
@endpush

@section('titulo')
   Registrar Compra
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">


                <form action="{{ route('compras.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4 flex">
                        <div class="w-1/2 mr-2">
                            <label for="proveedor_id" class="block mb-2 font-semibold">Proveedor:</label>
                            <select name="proveedor_id" id="proveedor_id" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                <option value="">Seleccione un proveedor</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input id="precio" type="text" name="precio" value="{{$producto->precio_compra}}" style="display: none;">
                        <input type="text" name="producto_id" value="{{ $producto->id }}" style="display: none;">

                        <div class="w-1/2 ml-2">
                            <label for="referencia" class="block mb-2 font-semibold">Referencia:</label>
                            <input type="text" name="referencia" id="referencia" placeholder="Ingrese la referencia" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        </div>
                    </div>

                    <div class="mb-4 flex">
                        <div class="w-1/2 mr-2">
                            <label for="fecha" class="block mb-2 font-semibold">Fecha:</label>
                            <input value="{{$fechaActual}}" type="date" name="fecha" id="fecha" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        </div>
                        <div class="w-1/2 ml-2">
                            <label for="cantidad" class="block mb-2 font-semibold">Cantidad:</label>
                            <input type="number" name="cantidad" id="cantidad" placeholder="Ingrese la cantidad" required class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                                oninput="updateTotal()">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="total" class="block mb-2 font-semibold">Total:</label>
                        <input type="number" name="total" id="total" placeholder="Total" required readonly class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
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
                <a href="{{ route('compras.show') }}">
                  <img src="{{ asset('img/compras.png') }}" alt="Imagen" class="flex flex-col justify-center w-48 h-48 rounded-sm">
                  <h3 class="text-blue-700 text-center">Compras</h3>
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
    // Función para actualizar el campo "Total" automáticamente
    function updateTotal() {
        const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
        const costoUnitario = parseFloat(document.getElementById('precio').value) || 0;
        const total = cantidad * costoUnitario;
        document.getElementById('total').value = total.toFixed(2);
    }
</script>

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
