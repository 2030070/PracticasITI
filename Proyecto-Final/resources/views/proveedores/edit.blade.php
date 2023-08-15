@extends('layouts.app')

@section('titulo')
   Editar Proveedor
@endsection

@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
        <div class="col-span-1 md:col-span-2">
            <div class="">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form action="{{ route('proveedores.update', $proveedor->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4 flex">
                            <div class="w-1/2 mr-2">
                                <label for="nombre" class="block mb-2 font-semibold">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" value="{{ $proveedor->nombre }}" required
                                    class="focus:shadow-primary-outline dark:text-white/80 
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none">
                            </div>

                            <div class="w-1/2 ml-2">
                                <label for="codigo" class="block mb-2 font-semibold">Código:</label>
                                <input type="text" name="codigo" id="codigo" value="{{ $proveedor->codigo }}" required
                                    class="focus:shadow-primary-outline dark:text-white/80 
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none">
                            </div>
                        </div>

                        <div class="mb-4 flex">
                            <div class="w-1/2 mr-2">
                                <label for="telefono" class="block mb-2 font-semibold">Teléfono:</label>
                                <input type="text" name="telefono" id="telefono" value="{{ $proveedor->telefono }}" required
                                    class="focus:shadow-primary-outline dark:text-white/80 
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none">
                            </div>

                            <div class="w-1/2 ml-2">
                                <label for="email" class="block mb-2 font-semibold">Email:</label>
                                <input type="email" name="email" id="email" value="{{ $proveedor->email }}" required
                                    class="focus:shadow-primary-outline dark:text-white/80 
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none">
                            </div>
                        </div>

                        <div class="mb-4 flex">
                            <div class="w-1/2 mr-2">
                                <label for="pais" class="block mb-2 font-semibold">País:</label>
                                <select name="pais" id="pais" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white  bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                    <option value="">Seleccione un país</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->name }}" @if ($country->name == $proveedor->pais) selected @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="w-1/2 ml-2">
                                <label for="estado" class="block mb-2 font-semibold">Estado:</label>
                                <select name="estado" id="estado" class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                    <option value="">Seleccione un estado</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->state_name }}" @if ($state->state_name == $proveedor->estado) selected @endif>{{ $state->state_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="ciudad" class="block mb-2 font-semibold">Ciudad:</label>
                            <input type="text" name="ciudad" id="ciudad" value="{{ $proveedor->ciudad }}" required
                                class="focus:shadow-primary-outline dark:text-white/80 
                                        text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                        bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                        focus:border-fuchsia-300 focus:outline-none">
                        </div>

                        <div class="mb-5">
                            <label for="descripcion" class="block mb-2 font-semibold">Descripción:</label>
                            <textarea name="descripcion" id="descripcion" placeholder="Ingrese la descripción" required
                                class="focus:shadow-primary-outline dark:text-white/80 text-sm leading-7 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all focus:border-fuchsia-300 focus:outline-none">
                                {{ $proveedor->descripcion }}
                            </textarea>
                        </div>

                        <div>
                            <input type="submit" value="Actualizar"
                                class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 
                                hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md 
                                bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
    </div>
</div>
@endsection
