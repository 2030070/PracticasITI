@extends('layouts.app')

@section('titulo')
   Crear Cotizacion
@endsection


@section('contenido')
<div class="container mx-auto px-4">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div class="col-span-1 md:col-span-1"></div> <!-- Espacio en blanco para el menú lateral -->
      <div class="col-span-1 md:col-span-2">
        <div class="container-fluid py-4">
            <div class="card mb-4">
                {{-- Mensaje --}}
                @if (session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('mensaje') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('warning') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-body px-4 pt-2 pb-2">
                    <div class="container mx-auto">
                        <div class="flex">
                            <div class="container">
                                <div class="col flex justify-start">
                                    <a href="{{ route('registrar-cotizacion-form') }}"
                                       class="btn bg-gradient-primary mt-4 mx-2 align-content-center flex-wrap"
                                       type="submit">
                                        Mostrar todos los productos
                                    </a>
                                </div>
                            </div>
                        </div>
                
                        <div id="categoriaCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($categorias->chunk(3) as $chunk)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <div class="grid grid-cols-3">
                                            @foreach ($chunk as $categoria)
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-header p-0 mx-3 mt-3 relative z-10">
                                                            <a href="{{ route('filtrar-productos-cotizacion', $categoria->id) }}"
                                                               class="d-block flex justify-center">
                                                                <img src="{{ asset('uploads/' . $categoria->imagen) }}"
                                                                     alt="Imagen del producto" class="w-full h-auto object-cover rounded-lg mb-0">
                                                            </a>
                                                        </div>
                                                        <div class="card-body pt-4 flex justify-center">
                                                            <span class="text-gradient text-primary uppercase font-bold my-2">
                                                                {{ $categoria->nombre }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <!-- Previous and Next buttons -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#categoriaCarousel"
                                    data-bs-slide="prev">
                                <span class="flex justify-start" aria-hidden="true">
                                    <img src="{{ asset('images/icons/icon-arrowright.svg') }}" alt="arrow right" class="w-30">
                                </span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#categoriaCarousel"
                                    data-bs-slide="next">
                                <span class="flex justify-end" aria-hidden="true">
                                    <img src="{{ asset('images/icons/icon-arrowleft.svg') }}" alt="arrow right" class="w-30">
                                </span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                
                        <div class="container mx-auto mt-5">
                            @if (isset($productosfiltrados))
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($productosfiltrados as $producto)
                                        <div class="col mb-4">
                                            <div class="card">
                                                <div class="card">
                                                    <form action="{{ route('agregar-cotizacion') }}" method="POST" novalidate>
                                                        @csrf
                
                                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                
                                                        <a class="flex justify-center">
                                                            <img src="{{ asset('uploads/' . $producto->imagen) }}"
                                                                 alt="Imagen del producto" class="w-full h-auto object-cover rounded-lg mb-0">
                                                        </a>
                
                                                        <div class="card-body">
                                                            <span class="text-gradient text-primary uppercase font-bold my-2">
                                                                {{ $producto->categoria->nombre }}
                                                            </span>
                                                            <br>
                                                            <span class="text-gradient text-info uppercase font-bold my-2">
                                                                {{ $producto->marca->nombre }}
                                                            </span>
                                                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                                                            <p class="card-text">Precio de venta: ${{ $producto->precio_venta }}</p>
                                                            <p class="card-text">Unidades disponibles: {{ $producto->unidades_disponibles }}</p>
                                                            <div class="flex justify-start pb-2">
                                                                <div class="flex items-center">
                                                                    <p class="card-text">Cantidad:</p>
                                                                </div>
                                                                <div class="input-group input-group-sm ms-2 me-6">
                                                                    <input class="form-control" type="number" name="cantidad_venta"
                                                                           id="cantidad_venta" min="1"
                                                                           max="{{ $producto->unidades_disponibles }}" value="cantidad_venta"
                                                                           placeholder="1">
                                                                </div>
                                                            </div>
                                                            <button class="btn bg-gradient-primary" name="agregar" value="add">Añadir</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <!-- Show all products without filtering -->
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach ($todosLosProductos as $producto)
                                        <div class="col mb-4">
                                            <div class="card">
                                                <div class="card">
                                                    <form action="{{ route('agregar-cotizacion') }}" method="POST" novalidate>
                                                        @csrf
                
                                                        <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                
                                                        <a class="flex justify-center">
                                                            <img src="{{ asset('uploads/' . $producto->imagen) }}"
                                                                 alt="Imagen del producto" class="w-full h-auto object-cover rounded-lg mb-0">
                                                        </a>
                
                                                        <div class="card-body">
                                                            <span class="text-gradient text-primary uppercase font-bold my-2">
                                                                {{ $producto->categoria->nombre }}
                                                            </span>
                                                            <br>
                                                            <span class="text-gradient text-info uppercase font-bold my-2">
                                                                {{ $producto->marca->nombre }}
                                                            </span>
                                                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                                                            <p class="card-text">Precio de venta: ${{ $producto->precio_venta }}</p>
                                                            <p class="card-text">Unidades disponibles: {{ $producto->unidades_disponibles }}</p>
                                                            <div class="flex justify-start pb-2">
                                                                <div class="flex items-center">
                                                                    <p class="card-text">Cantidad:</p>
                                                                </div>
                                                                <div class="input-group input-group-sm ms-2 me-6">
                                                                    <input class="form-control" type="number" name="cantidad_venta"
                                                                           id="cantidad_venta" min="1"
                                                                           max="{{ $producto->unidades_disponibles }}" value="cantidad_venta"
                                                                           placeholder="1">
                                                                </div>
                                                            </div>
                                                            <button class="btn bg-gradient-primary" name="agregar" value="add">Añadir</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                
                    <div class="container mx-auto">
                        <div class="flex">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header pb-2">
                                        <div class="flex justify-between items-center mx-4">
                                            <h6 class="mb-0">Productos agregados</h6>
                                        </div>
                                    </div>
                
                                    @php
                                        $tabla = session()->get('tabla', []);
                                        $subtotal = 0;
                                        $impuestos = 0;
                                        $total = 0;
                                    @endphp
                
                                    <div class="card-body px-4 pt-2 pb-2">
                                        <div class="table-responsive p-0">
                                            <table class="table items-center mb-0 text-center">
                                                <thead>
                                                <tr>
                                                    <th scope="col text-uppercase text-secondary text-xxs font-bold opacity-70">
                                                        Producto
                                                    </th>
                                                    <th scope="col text-uppercase text-secondary text-xxs font-bold opacity-70">
                                                        Precio
                                                    </th>
                                                    <th scope="col text-uppercase text-secondary text-xxs font-bold opacity-70">
                                                        Cantidad
                                                    </th>
                                                    <th scope="col text-uppercase text-secondary text-xxs font-bold opacity-70">
                                                        Subtotal
                                                    </th>
                                                    <th scope="col text-uppercase text-secondary text-xxs font-bold opacity-70">
                                                        Impuestos
                                                    </th>
                                                    <th scope="col text-uppercase text-secondary text-xxs font-bold opacity-70">
                                                        Acciones
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <!-- Initialize these fields -->
                                                @php
                                                    $totalImpuestos = 0;
                                                    $cantidadProductos = 0;
                                                    $subtotal = 0;
                                                @endphp
                                                @foreach ($tabla as $producto_id => $producto)
                                                    @php
                                                        $cantidadProductos += $producto['cantidad'];
                                                        $subtotal += $producto['precio'] * $producto['cantidad'];
                                                        $totalImpuestos += $producto['precio'] * $producto['cantidad'] * 0.16;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <div class="flex px-2 py-1">
                                                                <div>
                                                                    <img src="{{ asset('uploads/' . $producto['imagen']) }}"
                                                                         alt="Imagen del producto"
                                                                         class="w-full h-auto object-cover rounded-lg mb-0"
                                                                    >
                                                                </div>
                                                                <div class="mx-3 flex justify-center items-center">
                                                                    <h6 class="mb-0 text-sm">{{ $producto['nombre'] }}</h6>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>${{ number_format($producto['precio'], 2) }}</td>
                                                        <td>{{ $producto['cantidad'] }}</td>
                                                        <td>${{ number_format($producto['precio'] * $producto['cantidad'], 2) }}</td>
                                                        <td>${{ number_format($producto['precio'] * $producto['cantidad'] * 0.16, 2) }}</td>
                                                        <td>
                                                            <div class="flex justify-center items-center">
                                                                <form action="{{ route('eliminar-cotizacion') }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="producto_id" value="{{ $producto_id }}">
                                                                    <button class="btn bg-gradient-danger mt-3" name="eliminar"
                                                                            value="delete">
                                                                        Eliminar
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td class="text-right font-bold">Impuestos total:</td>
                                                    <td>${{ number_format($totalImpuestos, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td class="text-right font-bold">Subtotal:</td>
                                                    <td>${{ number_format($subtotal, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4"></td>
                                                    <td class="text-right font-bold">Cotización total:</td>
                                                    <td>${{ number_format($subtotal + $totalImpuestos, 2) }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="flex justify-start">
                                            <form action="{{ route('cotizacion-store') }}" method="POST" novalidate>
                                                @csrf
                
                                                <div class="grid grid-cols-4 gap-4">
                                                    <div class="col">
                                                        <div class="input-group input-group-sm ms-2 me-10">
                                                            <input class="form-control" type="date" name="fecha" id="fecha"
                                                                   value="{{ old('fecha') }}" placeholder="Fecha">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm ms-2 me-10">
                                                            <select class="form-control" name="cliente_id" id="cliente_id">
                                                                <option value="" selected disabled>Selecciona un cliente</option>
                                                                @foreach ($clientes as $cliente)
                                                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre_cliente }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm ms-2 me-10">
                                                            <input class="form-control" type="text" name="codigo_referencia"
                                                                   id="codigo_referencia" value="{{ old('codigo_referencia') }}"
                                                                   placeholder="Codigo de referencia">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="input-group input-group-sm ms-2 me-10">
                                                            <input class="form-control" name="descripcion_cotizacion"
                                                                   id="descripcion_cotizacion" placeholder="Descripcion de la cotizacion">
                                                        </div>
                                                    </div>
                                                </div>
                
                                                <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                                <input type="hidden" name="totalImpuestos" value="{{ $totalImpuestos }}">
                                                <input type="hidden" name="total" value="{{ $subtotal + $totalImpuestos }}">
                                                <input type="hidden" name="status_cotizacion" value="iniciada" id="status_cotizacion">
                
                                                <div class="flex justify-end">
                                                    <button class="btn bg-gradient-primary mt-4 mx-2" name="guardar" value="save">
                                                        Guardar cotización
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

        </div>
      </div>
      <div class="col-span-1 md:col-span-1">
        <div class="sticky top-0 h-screen p-4 rounded-lg">
          <div class="flex flex-col items-center gap-4 bg-blue-500/13 rounded-lg p-4">
            {{-- <a href="{{route('cotizaciones.show')}}"> --}}
              <img src="{{ asset('img/cotizacion.png') }}" alt="Imagen" class="w-48 h-48 rounded-sm">
              <h3 class="text-blue-700">Ver Cotizaciones</h3>
            </a> 
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
