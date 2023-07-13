@extends('layouts.app')

@section('nav')

<div class="container sticky top-0 z-sticky">
    <div class="flex flex-wrap -mx-3">
      <div class="w-full max-w-full px-3 flex-0">
        <!-- Navbar para el contenido del nav que es desplegable en todas las pantallas-->
        <nav class="absolute top-0 left-0 right-0 z-30 flex flex-wrap items-center px-4 py-2 m-6 mb-0 shadow-sm rounded-xl bg-sky-100/70 backdrop-blur-2xl backdrop-saturate-200 lg:flex-nowrap lg:justify-start">
          <div class="flex items-center justify-between w-full p-0 px-6 mx-auto flex-wrap-inherit">
            <a class="py-1.75 text-sm mr-4 ml-4 whitespace-nowrap font-bold text-slate-700 lg:ml-0" href="{{route('post_index')}}" target="_blank"> Proyecto Final </a>
            <button navbar-trigger class="px-3 py-1 ml-2 leading-none transition-all ease-in-out bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-lg lg:hidden" type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6 h-6 bg-none">
                <span bar1 class="w-5.5 rounded-xs relative my-0 mx-auto block h-px bg-blue-500 transition-all duration-300"></span>
                <span bar2 class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-blue-500 transition-all duration-300"></span>
                <span bar3 class="w-5.5 rounded-xs mt-1.75 relative my-0 mx-auto block h-px bg-blue-500 transition-all duration-300"></span>
              </span>
            </button>
            <div navbar-menu class="items-center flex-grow transition-all duration-500 lg-max:overflow-hidden ease lg-max:max-h-0 basis-full lg:flex lg:basis-auto">
              <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
                <li>
                  @auth
                  <nav class="flex gap-2 items-center">
                      <form method="POST" action="{{route('logout')}}">
                          @csrf
                          <button type="submit"
                              class="block px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-sm text-slate-700 lg:px-2  hover:bg-blue-300 rounded-md ease-nav-brand">
                              <i class="fas fa-sign-out-alt lg:mr-1"></i>
                              Cerrar sesión
                          </button>
                      </form>
                  </nav>
                  @endauth
                </li>
                @guest
                <li>
                  <a class="block px-4 py-2 mr-2 font-normal transition-all ease-in-out lg-max:opacity-0 duration-250 text-sm text-slate-700 lg:px-2 hover:bg-blue-300 rounded-md ease-nav-brand" href="{{route('login')}}">
                    <i class="mr-1 fas fa-key opacity-60"></i>
                    Iniciar Sesion
                  </a>
                </li>
                @endguest
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection


@section('contenido')
@guest
<body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
    <main class="mt-0 transition-all duration-200 ease-in-out">
        <section>
            <div class="relative flex items-center min-h-screen p-0 overflow-hidden bg-center bg-cover">
                <div class="container z-1">
                    <div class="flex flex-wrap mx-3">
                      <div class="absolute top-10 right-0 justify-center flex-col w-full h-full max-w-full px-3 py-20 mx-auto lg:mx-0 shrink-0 md:flex-0 md:w-6/12 lg:w-5/12 xl:w-4/12">
                        <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none lg:py4 bg-clip-border rounded-xl">
                            <div class="p-6 pb-0 mb-0">
                                <h4 class="font-bold text-center text-blue-500">Iniciar Sesión</h4>
                            </div>
                            <div class="flex-auto p-6">
                                <form method="POST" action="{{route('login')}}" novalidate>
                                    @csrf
                                    @if(session('mensaje'))
                                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                                            {{session('mensaje')}}
                                        </p>
                                    @endif
                                    <div class="mb-4">
                                        <input type="email" id="email" name="email" required placeholder="Email" class="focus:shadow-primary-outline dark:text-white/80 
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none @error('email')  @enderror" value="{{old('email')}}" />
                                    </div>
                                    <div class="mb-4">
                                        <input type="password" id="password" name="password" required placeholder="Password" class="focus:shadow-primary-outline dark:text-white/80
                                            text-sm leading-5.6 ease block w-full appearance-none rounded-lg border-2 border-blue-500 bg-white 
                                            bg-clip-padding p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 
                                            focus:border-fuchsia-300 focus:outline-none @error('password') @enderror" value="{{old('password')}}" />
                                    </div>
                    
                                    <div>
                                        <input type="submit" value="Iniciar Sesión"
                                            class="inline-block px-16 py-3.5 mt-6 mb-0 align-middle transition-all bg-blue-500 border-0 
                                            hover:-translate-y-px active:opacity-85 hover:shadow-xs text-sm ease-in tracking-tight-rem shadow-md 
                                            bg-150 bg-x-25 cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                        <div class="absolute top-0 left-0 flex-col justify-center hidden w-7/12  h-full max-w-full px-3 pl-0 my-auto text-center flex-0 lg:flex">
                            <div class="relative flex flex-col justify-center h-full bg-cover px-24 m-4 overflow-hidden 
                            bg-[url('https://i.blogs.es/953f95/liondp3wallpaper/450_1000.webp')] rounded-xl ">
                                <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-blue-500 to-violet-500 opacity-60"></span>
                                <h4 class="z-20 mt-12 font-bold text-white">"Bienvenido a nuestro ¡POS!"</h4>
                                <span class="z-20 mt-12 font-bold text-white"> Integrantes: EQUIPO-08 <br>Cesar Aldahir Flores Gámez <br>Jorge Guevara García <br> Martinez Zuñiga Juan Eduardo <br></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</body>
@endguest


@endsection
