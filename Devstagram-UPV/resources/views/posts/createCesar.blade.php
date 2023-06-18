@extends('layouts.app')

@section('titulo')
    Crear publicaciones
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center" style="margin-top: 1cm;">
        {{-- <div class="md:w-5/12 order-last md:order-first p-5">
            <!-- Insertar imagen utilizando "asset" (acceder a carpeta public) -->
            <div style="position: relative; display: inline-block;">
                <img id="preview-image" src="{{ asset('img/**') }}" alt="Imagen registro de usuarios"
                    style="border-radius: 15px; border: 3px solid #617a7a;">
                    <p id="image-size" class="text-gray-700 text-lg mt-2" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); font-size: 30px; font-weight: bold;"></p>
                </div>
        </div> --}}
        
        
        <div class="md:w-5/12 bg-white p-6 rounded-lg shadow-xl order-first md:order-last">
            <form action="/target" class="dropzone" id="my-great-dropzone" style="border: 2px solid; border-radius: 20px; border-image: linear-gradient(to right, #ff00ff, #00ffff); border-image-slice: 1;">
                
                <div class="mb-8">
                    <textarea id="description" name="description" placeholder="Escribe la descripción de la publicación" class="border p-3 w-full h-40 rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="url(#gradient)" class="w-14 h-14 text-gray-400">
                        <defs>
                            <linearGradient id="gradient" gradientTransform="rotate(90)">
                                <stop offset="0%" stop-color="#ff00ff"></stop>
                                <stop offset="100%" stop-color="#00ffff"></stop>
                            </linearGradient>
                        </defs>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Arrastra y suelta la imagen aquí o haz clic para seleccionarla.</p>
                </div>
                
            </form>
            <div class="flex justify-center mt-4">
                <a href="{{ route('post_index') }}" class="text-gray-500 underline">
                    <button class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 text-gray-200 py-2 px-4 rounded-full focus:outline-none hover:shadow-lg">
                        Cancelar
                    </button>
                </a>
                <a href="{{ route('post_index') }}" class="text-gray-500 underline">
                    <button class="bg-gradient-to-r from-blue-400 via-cyan-500 to-cyan-600 text-white py-2 px-4 rounded-full focus:outline-none hover:shadow-lg mx-2">
                        Publicar
                    </button>
                </a>
            </div>
            
            <script>
                Dropzone.options.myGreatDropzone = {
                    paramName: "file",
                    maxFilesize: 2,
                    addRemoveLinks: true,
                    accept: function(file, done) {
                        if (file.name == "justinbieber.jpg") {
                            done("Naha, you don't.");
                        } else {
                            done();
                        }
                    },
                    init: function() {
                        var dropzone = this;
                        this.on("removedfile", function(file) {
                            // Aquí puedes realizar cualquier acción adicional cuando se elimine un archivo.
                            // Por ejemplo, puedes hacer una solicitud AJAX para eliminarlo del servidor.
                            // En este ejemplo, simplemente eliminaremos el archivo del DOM.
                            var _ref;
                            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                        });
                    }
                };
            </script>

            {{-- novalidate para validar cosas del lado del servidor --}}

            {{-- <form action="{{ route('register') }}" method="POST" novalidate enctype="multipart/form-data">
                @csrf

                <div class="mb-8">
                    <label for="description" class="mb-2 block uppercase text-cyan-700 font-bold">Descripción</label>
                    <textarea id="description" name="description" placeholder="Escribe la descripción de la publicación"
                        class="border p-3 w-full h-32 rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="image" class="mb-2 block uppercase text-cyan-700 font-bold">Imagen</label>
                    <input id="image" name="image" type="file" accept="image/*"
                        class="hidden @error('image') border-red-500 @enderror" onchange="previewImage(event)" />
                    <div id="image-preview" class="border border-gray-300 p-2 rounded-lg">
                        <div id="image-dropzone" class="h-60 flex flex-col items-center justify-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                class="w-12 h-12 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-600">Arrastra y suelta la imagen aquí o haz clic para seleccionarla.</p>
                        </div>
                    </div>
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
                                // img.style.opacity = '01'; // Add opacity to the image
                                const previewImage = document.getElementById('preview-image');
                                previewImage.src = img.src;
                                const imageSize = document.getElementById('image-size');
                                imageSize.textContent = `Image Size: \n${formatBytes(file.size)}`;
                            };
                            reader.readAsDataURL(file);
                        }

                        function formatBytes(bytes, decimals = 2) {
                            if (bytes === 0) return '0 Bytes';
                            const k = 1024;
                            const dm = decimals < 0 ? 0 : decimals;
                            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
                            const i = Math.floor(Math.log(bytes) / Math.log(k));
                            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
                        }
                    </script>

                <input type="submit" value="Crear Publicación"
                    class="bg-gray-800 hover:bg-gray-800 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
            </form> --}}
        </div>
    </div>
@endsection
