@extends('layouts.app')

@section('titulo')
    Crear publicaciones
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-5/12 order-last md:order-first p-5">
            <!-- Insertar imagen utilizando "asset" (acceder a carpeta public) -->
            <img id="preview-image" src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios"
                style="border-radius: 15px; border: 3px solid #617a7a;">
        </div>
        <div class="md:w-5/12 bg-white p-6 rounded-lg shadow-xl order-first md:order-last">
            {{-- novalidate para validar cosas del lado del servidor --}}
            <form action="{{ route('register') }}" method="POST" novalidate enctype="multipart/form-data">
                {{-- csrf sirve para evitar ataques de bots y evitar llenar la tabla de datos basura --}}
                {{-- También crea un token seguro --}}
                @csrf

                <div class="mb-8">
                    <label for="description" class="mb-2 block uppercase text-cyan-700 font-bold">Descripción</label>
                    <textarea id="description" name="description" placeholder="Escribe la descripción de la publicación"
                        class="border p-3 w-full h-32 rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="image" class="mb-2 block uppercase text-cyan-700 font-bold">Imagen</label>
                    <input id="image" name="image" type="file" accept="image/*"
                        class="hidden @error('image') border-red-500 @enderror" onchange="previewImage(event)" />
                    <div id="image-preview" class="border border-gray-300 p-2 rounded-lg">
                        <div id="image-dropzone" class="h-40 flex flex-col items-center justify-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="w-12 h-12 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">Arrastra y suelta la imagen aquí o haz clic para seleccionarla.</p>
                        </div>
                    </div>
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('image')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

            
                    <script>
                        const imageDropzone = document.getElementById('image-dropzone');
                        const imageInput = document.getElementById('image');

                        imageDropzone.addEventListener('click', function() {
                            imageInput.click();
                        });

                        imageDropzone.addEventListener('dragover', function(e) {
                            e.preventDefault();
                            this.classList.add('border-blue-500');
                        });

                        imageDropzone.addEventListener('dragleave', function(e) {
                            e.preventDefault();
                            this.classList.remove('border-blue-500');
                        });

                        imageDropzone.addEventListener('drop', function(e) {
                            e.preventDefault();
                            this.classList.remove('border-blue-500');
                            const file = e.dataTransfer.files[0];
                            imageInput.files = e.dataTransfer.files;
                            previewImageFromFile(file);
                        });

                        function previewImage(event) {
                            const input = event.target;
                            if (input.files && input.files[0]) {
                                const file = input.files[0];
                                previewImageFromFile(file);
                            }
                        }

                        function previewImageFromFile(file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = document.createElement('img');
                                img.src = e.target.result;
                                img.classList.add('w-full', 'h-auto');
                                const previewImage = document.getElementById('preview-image');
                                previewImage.src = img.src;
                            };
                            reader.readAsDataURL(file);
                        }
                    </script>

                <input type="submit" value="Crear Publicación"
                    class="bg-gray-800 hover:bg-gray-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form>
        </div>
    </div>
@endsection
