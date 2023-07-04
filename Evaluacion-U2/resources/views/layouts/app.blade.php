<!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Elimina estilos --}}
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        {{-- @vite('resources/css/styles.css') --}}
        <title>Facturas @yield('titulo')</title>
        @stack('styles')
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <!-- Styles -->
        
    </head>
    {{-- Cuerpo principal --}}
    <body class="h-full bg-gray-100" >
        <div class="min-h-full">
            {{-- seccion del menu de opciones --}}
            <nav class="bg-blue-500">
              <div class="mx-auto max-w-7xl py-3">
                <div class="flex h-16 items-center justify-between">
                  <div class="container mx auto flex justify-between items-center">
                    <div class="flex-shrink-0">
                      {{-- {{route('post_index',[auth()->user()->username])}} --}}
                        <h1 class="text-3xl font-bold text-white"><a href="#">Facturas</a></h1>
                    </div>
                    <div class="hidden md:block">
                      <div class="ml-10 flex items-baseline space-x-4">
                        @auth
                          
                          <nav class="flex gap-2 items-center text-gray-200" >
                          
                            {{-- Agregar seguridad al logout --}}
                            <form method="POST" action="{{route('logout')}}">
                              @csrf
                              <button type="submit" class="font-bold uppercase text-bold text-white text-sm flex items-center">
                                  <span class="ml-2">Log Out</span>
                                  <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="#ffffff" viewBox="0 0 256 256">
                                      <path d="M112,216a8,8,0,0,1-8,8H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h56a8,8,0,0,1,0,16H48V208h56A8,8,0,0,1,112,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L196.69,120H104a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,221.66,122.34Z">
                                      </path>
                                  </svg>
                              </button>
                            
                            </form>

                          </nav>
                        @endauth

                        @guest
                          <div class="hidden md:block">
                            <div class="ml-10 flex items-baseline space-x-4">
                              <a class="text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium" href="{{route('login')}}"> Login</a>
                              <a class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-base font-medium">
                              
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#FFFFFF" viewBox="0 0 256 256">
                                    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                                </svg>
                              </a>
                            
                            
                            </div>
                          </div> 
                        @endguest
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </nav>

            <!-- Crear un contenedor dinamico -->
            @yield('nav')

            @yield('header')
            <main class="container mx-auto mt-10">
              <h2 class="font-black text-blue-500 text-center text-3xl mb-10">
                  @yield('titulo')
              </h2>
              <!-- COntenedor para traer el contenido de las diferentes frames .blade.php -->
              @yield('contenido')
            </main>
        </div>
        {{-- Diseño del footer es decir el pie de pagina --}}
        <footer class="bg-blue-500 py-4">
          <div class="container mx-auto px-4 text-lg text-gray-300 text-center " >
              <p>Copyright &copy; César Aldahir Flores Gámez
                  <span id="date"></span>. all rights reserved {{now()->year}}</p>
          </div>
        </footer>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.js" integrity="sha512-sk0cNQsixYVuaLJRG0a/KRJo9KBkwTDqr+/V94YrifZ6qi8+OO3iJEoHi0LvcTVv1HaBbbIvpx+MCjOuLVnwKg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
        <script>
            function exportToPDF(tipo) {
                var maintable = document.getElementById('maintable');
                var pdfout = document.getElementById('pdfout');
                var doc = new jsPDF('p', 'pt', 'letter');
                var margin = 20;
                var scale = (doc.internal.pageSize.width - margin * 2) / document.body.clientWidth;
                var scale_mobile = (doc.internal.pageSize.width - margin * 2) / document.body.getBoundingClientRect();

                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    doc.html(maintable, {
                        x: margin,
                        y: margin,
                        html2canvas: {
                            scale: scale,
                            ignoreElements: function (element) {
                                return element.classList.contains('exclude-column');
                            }
                        },
                        callback: function (doc) {
                            doc.save(tipo + '.pdf');
                        }
                    });
                } else {
                    doc.html(maintable, {
                        x: margin,
                        y: margin,
                        html2canvas: {
                            scale: scale,
                            ignoreElements: function (element) {
                                return element.classList.contains('exclude-column');
                            }
                        },
                        callback: function (doc) {
                            doc.save(tipo + '.pdf');
                        }
                    });
                }
            }

            
            function exportToExcel(tipo) {
                const table = document.querySelector('.table-auto');
                const ws = XLSX.utils.table_to_sheet(table);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'Facturas');
                XLSX.writeFile(wb, tipo + '.xlsx');
            }
        </script>
    </body>
</html>
