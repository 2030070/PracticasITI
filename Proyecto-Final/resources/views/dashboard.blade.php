@extends('layouts.app')

@section('titulo')
   Dashboard
@endsection


@section('contenido')
<style>
  .containerCard {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  
  .card {
    width: calc(33.33% - 40px);
    margin-bottom: 40px;
    font-size: 24px;
    transition: transform 0.5s;
  }
  
  .card:hover {
    transform: scale(1.15);
  }
</style>

<div class="container mx-auto">
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div class="col-span-1/2 md:col-span-1/2"></div> <!-- Espacio en blanco para el menú lateral -->
      <div class="col-span-2 md:col-span-3 ">
        <div class="containerCard">
          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Productos</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Producto::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      {{-- <a href="{{route('productos.show')}}"></a> --}}
                      <a href="{{ route('productos.show') }}" >
                        <i class="relative top-0 text-xl text-purple-300 fas fa-box-open"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Categorias</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Categoria::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="{{ route('categorias.show') }}" >
                        <i class="relative top-0 text-xl text-purple-300 fas fa-folder-open"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Subcategorías</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Subcategoria::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="{{ route('subcategorias.show') }}" >
                        <i class="relative top-0 text-xl text-purple-300 fas fa-folder"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Marcas</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Marca::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="{{ route('marcas.show') }}" >
                        <i class="relative top-0 text-xl text-purple-300 fas fa-tags"></i>
                      </a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Proveedores</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Proveedor::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="{{ route('proveedores.show') }}" >
                        <i class="relative top-0 text-xl text-purple-300 fas fa-truck"></i>
                      </a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Clientes</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Cliente::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="{{ route('clientes.show') }}" >
                        <i class="relative top-0 text-xl text-purple-300 fas fa-user"></i>
                      </a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Usuarios</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Usuario::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="{{ route('usuarios.show') }}" >
                        <i class="relative top-0 text-xl text-purple-300 fas fa-user"></i>
                      </a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Ventas</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Venta::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="{{ route('ventas.show') }}" >
                        <i class="relative top-0 text-xl text-purple-300 fas fa-chart-line"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Devoluciones</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: {{ App\Models\Devolucion::count() }}</h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="{{ route('devoluciones.show') }}" >
                        <i class="relative top-0 text-xl text-purple-300 fas fa-undo"></i>
                      </a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Cptozaciónes</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: </h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="#" >
                        {{-- <i class="relative top-0 text-xl text-purple-300 fas fa-user"></i> --}}
                      </a>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="card ">
            <div class="relative flex flex-col min-w-0 break-words bg-blue-300 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">Compras</p>
                      <h5 class="mb-2 font-bold dark:text-white">Total: </h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-100 to-teal-50">
                      
                      <a href="#" >
                        {{-- <i class="relative top-0 text-xl text-purple-300 fas fa-user"></i> --}}
                      </a>

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
@endsection
