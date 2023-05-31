@extends('auth.dashboard')
{{-- @vite('resources/css/app.css') --}}
@section('form')
<div class="md:flex md:justify-tio md:gap-10 md:items-center" >
 
    <div class="md:w-12/12 bg-white p-10 rounded-xl shadow-xl">
        {{-- no validate para validar cosas del lado del serivdor --}}
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-bold text-cyan-700">Registrar Productos</h1>
        </div>
        {{-- Contenido del formulario --}}
        <div class="bg-white p-10 rounded-2xl">
            
            {{-- Formulario de registro de productos --}}
            <form action="{{ route('add_product') }}" method="POST" novalidate>
                {{-- Directiva de seguridad --}}
                @csrf

                {{-- Nombre --}}
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-cyan-700 font-bold">Nombre </label>
                    <input type="text" name="name" id="name" placeholder="Nombre"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-opacity-75">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('name')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Descripción corta --}}
                <div class="mb-5">
                    <label for="short_description" class="mb-2 block uppercase text-cyan-700 font-bold">Descripción corta</label>
                    <textarea name="short_description" id="short_description" cols="30" rows="10" placeholder="Descripción corta"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-opacity-75"></textarea>
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('short_description')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>


                {{-- Descripcion larga --}}
                <div class="mb-5">
                    <label for="long_description" class="mb-2 block uppercase text-cyan-700 font-bold">Descripción larga</label>
                    <textarea name="long_description" id="long_description" cols="30" rows="10" placeholder="Descripción larga"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-opacity-75"></textarea>
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('long_description')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>



                {{-- Precio de venta --}}
                <div class="mb-5">
                    <label for="sale_price" class="mb-2 block uppercase text-cyan-700 font-bold">Precio de venta</label>
                    <input type="number" name="sale_price" id="sale_price" placeholder="Precio de venta"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-opacity-75">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('sale_price')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Precio de compra --}}
                <div class="mb-5">
                    <label for="purchase_price" class="mb-2 block uppercase text-cyan-700 font-bold">Precio de compra </label>
                    <input type="number" name="purchase_price" id="purchase_price" placeholder="Precio de compra"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-opacity-75">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('purchase_price')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>


                {{-- Stock --}}
                <div class="mb-5">
                    <label for="stock" class="mb-2 block uppercase text-cyan-700 font-bold">Stock </label>
                    <input type="number" name="stock" id="stock" placeholder="Stock"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-opacity-75">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('stock')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- ID --}}
                <div class="mb-5">
                    <label for="product_id" class="mb-2 block uppercase text-cyan-700 font-bold">ID</label>
                    <input type="number" name="product_id" id="product_id" placeholder="ID"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-opacity-75">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('product_id')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Fecha --}}
                <div class="mb-5">
                    <label for="fecha" class="mb-2 block uppercase text-cyan-700 font-bold">Fecha</label>
                    <input type="date" name="fecha" id="fecha"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-opacity-75">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('fecha')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- peso --}}
                <div class="mb-5">
                    <label for="peso" class="mb-2 block uppercase text-cyan-700 font-bold">
                        Peso
                    </label>
                    <input type="text" name="peso" id="peso" placeholder="Peso"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline bg-opacity-75">
                    {{-- Directiva para mostrar mensaje de error --}}
                    @error('peso')
                        <span class="text-xs text-red-500 border-red-600 rounded">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="mb-5 flex justify-center">
                    <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-bold py-2 px-6 rounded-lg">
                        Agregar
                    </button>
                 </div>
            </form>

        </div>
    </div>
    
</div>
@endsection
