<!-- Crear una directiva para incluir la navegacion -->

@extends('layouts.app')


@section('titulo')
    Alumnos
@endsection 

@section('header')
  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-cyan-500 ">Listado de ALumnos</h1>
    </div>
  </header>
@endsection

@section('contenido')
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <!-- Your content -->
      <table class="min-w-full divide-y divide-gray-200 border-2 border-blue-900">
        <thead>
          <tr>
            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-lg font-medium text-gray-500 uppercase tracking-wider border-b-2 border-blue-900">ID</th>
            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-lg font-medium text-gray-500 uppercase tracking-wider border-b-2 border-blue-900">Nombre</th>
            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-lg font-medium text-gray-500 uppercase tracking-wider border-b-2 border-blue-900">Edad</th>
            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-lg font-medium text-gray-500 uppercase tracking-wider border-b-2 border-blue-900">Grado</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900">1</td>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900 text-lg">Juan Pérez</td>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900">18</td>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900">12°</td>
          </tr>
          <tr>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900">2</td>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900 text-lg">María López</td>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900">17</td>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900">11°</td>
          </tr>
          <tr>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900">3</td>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900 text-lg">Carlos Ramírez</td>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900">16</td>
            <td class="px-6 py-4 whitespace-nowrap border-b-2 border-blue-900">10°</td>
          </tr>
          <!-- Agrega más filas según sea necesario -->
        </tbody>
      </table>
    
    
    </div>
</main>
@endsection

