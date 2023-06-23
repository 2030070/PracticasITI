@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection
{{-- directiva para integrar los estilos de dropzone --}}
@push('styles')
    {{-- estilos dropzone --}}
    {{-- <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />  --}}
@endpush

@section('contenido')
    <div class="container mx-auto md:flex bg-white rounded-lg p-4 mb-4" >
        <div class="md:w-1/2">
            <div class=" rounded-lg p-4 mb-4">
                <!-- Contenido de la columna 1 -->
                <div class="flex items-center">
                    <img src="{{asset ('img/YO.jpg')}}" alt="Imagen de perfil" class="rounded-full w-12 h-12">
                    <p class="font-bold ml-4">{{$post->user->username}}</p>
                    <button class="focus:outline-none ml-auto">
                        <!-- Aquí va el código del botón de configuración -->
                    </button>
                </div>
                
            </div>
            <img src="{{asset('uploads'.'/'.$post->imagen)}}" alt="Imagen del post {{$post->titulo}}" class="rounded-md">
            <div class="p-3">
                <p>
                    <div class="p-3 flex items-center">
                        <button class="focus:outline-none mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                            </svg>
                        </button>
                        <button class="focus:outline-none mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                            </svg>
                        </button>
                        <button class="focus:outline-none ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                            </svg>
                        </button>
                    </div>
                    <div class=" rounded-lg p-4 mb-4">
                         {{-- <p class="m-0">0 likes</p> --}}
                        <p class="mt-5">
                            {{$post->descripcion}}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{$post->created_at->diffForHumans()}}
                        </p>
                    </div>
                    
                </p>
            </div>
            @auth
                @if($post->user_id === auth()->user()->id)
                    <form method="POST" action="{{route('posts.destroy', $post)}}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" value="Eliminar publicacion"  class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"/>
                    </form>
                @endif
            @endauth
        </div>
        <div class="md:w-1/2">
            @auth
            <!-- Contenido de la columna 2 -->
                <div class="shadow p-5 mb-5">
                    <p class="text-xl font-bold text-center nb-4">Agregar nuevo comentario</p>
                    @if(session('mensaje'))
                        <div class="bg-green-500 p-2 rounded-lg nb-6 text-white text-center uppercase font-bold">
                            {{session('mensaje')}}
                        </div>
                    @endif
                    
                        <form action="{{route('comentarios.store',[$post->user->username,'post'=>$post])}}" method="POST">
                            @csrf
                            <div class="mb-5">
                                <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                                    Añade un Comentario
                                </label>
                                <textarea id="comentario" name="comentario" placeholder="Escribe tu comentario. Ej: Hola, que bonita pc" class="border p-3 w-full h-40 rounded-lg @error('comentario') border-red-500 @enderror">{{ old('comentario') }}</textarea>
                                @error('comentario')
                                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                                @enderror
                            </div>
                            <input type="submit" value="comentar" class="bg-sky-800 hover:bg-sky-600 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                        </form>
                </div>
            @endauth        

            <div class="shadow rounded-md my-5 max-h-96 overflow-y-scroll">
                @if($post->comentarios->count() > 0)
                    @foreach($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b">
                            <a href="{{ route('post_index',$comentario->user) }}" class="font-bold">{{ $comentario->user->username }}</a>
                            <p>{{ $comentario->comentario }}</p>
                            <p class="text-sm text-gray-500">{{ $comentario->created_at->DiffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="p-10 text-center text-gray-700">No hay comentarios aún.</p>
                @endif
            </div>
            
        </div>
    </div>
@endsection



