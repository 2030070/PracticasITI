@extends('layouts.app')

@section('titulo')
   Consultar Ulientes
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1/2 md:col-span-1/2"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-2 md:col-span-3">
            @if(session('success'))
                <div class="bg-green-200 p-2 rounded-lg mb-6 text-black text-center ">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('actualizada'))
                <div class="bg-green-200 p-2 rounded-lg mb-6 text-black text-center ">
                    {{ session('actualizada') }}
                </div>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full border-2 border-blue-500 rounded-lg">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b text-left">Imagen</th>
                            <th class="py-2 px-4 border-b text-left">Nombre</th>
                            <th class="py-2 px-4 border-b text-left">Apellidos</th>
                            <th class="py-2 px-4 border-b text-left">Usuario</th>
                            <th class="py-2 px-4 border-b text-left">Teléfono</th>
                            <th class="py-2 px-4 border-b text-left">Correo</th>
                            <th class="py-2 px-4 border-b text-left">Status</th>
                            <th class="py-2 px-4 border-b text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td class="py-2 px-4 border-b text-left"><img src="{{ asset('uploads/'.$usuario->imagen) }}" alt="Imagen del usuario" class="w-20 h-20 object-cover"></td>
                            <td class="py-2 px-4 border-b text-left">{{ $usuario->nombre }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $usuario->apellidos }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $usuario->usuario }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $usuario->telefono }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $usuario->email }}</td>
                            <td class="py-2 px-4 border-b text-left">Pendiente</td>
                            <td class="py-2 px-4 border-b text-left">
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z">
                                            </path>
                                        </svg>
                                    </button>
                                </form>
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#3B82F6" viewBox="0 0 256 256">
                                        <path d="M227.32,73.37,182.63,28.69a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31l83.67-83.66,3.48,13.9-36.8,36.79a8,8,0,0,0,11.31,11.32l40-40a8,8,0,0,0,2.11-7.6l-6.9-27.61L227.32,96A16,16,0,0,0,227.32,73.37ZM48,179.31,76.69,208H48Zm48,25.38L51.31,160,136,75.31,180.69,120Zm96-96L147.32,64l24-24L216,84.69Z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $usuarios->links() }}
            </div>
        </div>
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    </div>
</div>
@endsection
