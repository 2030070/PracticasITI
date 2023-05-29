<!-- Crear una directiva para incluir la navegacion -->

@extends('layouts.app')

@section('titulo')
    Curriculum
@endsection

@section('header')
    <header class="bg-white shadow" style="background-image: url('./img/fondo.jpeg');">
        <div class="mx-auto max-w-7xl px-2 py-2 sm:px-2 lg:px-8">
            <nav id="nav" class="flex items-center justify-end">
                <div class="mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16">
                          <div class="ml-10 flex items-baseline space-x-4 text-2xl text-cyan-500 rounded-md font-medium">
                            <ul class="links">
                                <a href="#home" class="scroll-link px-3 py-2 ">Inicio</a>
                                <a href="#about" class="scroll-link px-3 py-2 ">Acerca de mi</a>
                                <a href="#curriculum" class="scroll-link px-3 py-2 ">Curriculum</a>
                                <a href="#multimedia" class="scroll-link px-3 py-2 ">Multimedia</a>
                                <a href="#contacto" class="scroll-link px-3 py-2 ">Contacto</a>
                            </ul>
                          </div>
                    </div>
            </nav>
            {{-- <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard</h1> --}}
        </div>
        <div class="bg-cover bg-center py-12">
            <div class="container mx-auto px-4 text-center text-white">
              <h1 class="text-6xl">César Aldahir <br> Flores Gámez</h1>
              <p class="text-2xl font-bold">¡Bienvenidos a mi One page!</p>
              <a href="#contact" class="scroll-link btn btn-white text-xl inline-block border-2 border-gray-500 rounded-lg p-2">
                Explorar proyectos
              </a>
              
              
            </div>
        </div>
    </header>
    <header id="header">
        {{-- <div class="bg-cover bg-center py-12">
            <div class="container mx-auto px-4">
              <h1 class="text-center text-cyan-900 text-6xl">César Aldahir <br> Flores Gámez</h1>
              <p class="text-cyan-900 text-center text-2xl font-bold">¡Bienvenidos a mi One page!</p>
              <a href="#contact" class="scroll-link btn btn-white text-cyan-900 text-center text-xl">Explorar proyectos</a>
            </div>
        </div> --}}

    </header>
@endsection

@section('contenido')
    {{-- Contenido para la seccion de acerca de mi, contiene una image y texto --}}
    <section id="about" class="section transform hover:scale-105 transition-transform duration-500" >
        <div class="title" id="sobreMi">
            <h2 class="text-5xl text-center" style="margin-top: 13px; margin-bottom: 13px;">
                <span class="text-gray-800"> ACERCA DE</span> 
                <span class="text-cyan-700"> MI</span>
            </h2>
            <div class="flex justify-center ">
                <img src="./img/YO.jpg" class="img-hover" width="200" height="200" style="border-radius: 15%; margin-top: 12px; margin-bottom: 12px;" >
            </div>
            <div class="text-center max-w-4xl mx-auto">
                <p class="text-justify text-1xl ">¡Hola!, me presento mi nombre es César Aldahir Flores Gámez, soy estudiante universitario en la carrera de Ingeniería en Tecnologías de la Información en la Universidad Politécnica de Victoria. 
                    Soy alguien que le gusta la tecnología, por ello una de las cosas que más me gusta hacer es programar.<br> 
                    Fuera de mi vida universitaria me gusta pasar tiempo con perosnas que aporten en mi vida pasando tiempo de calidad juntos, practicar deportes y convivir con mi familia.
                    Me apasiona la tecnología y todo lo relacionado con ella. En particular, me encanta programar.
                    Soy alguien que aspira a grandes cosas al salir de la universidad me gustaría explorar nuevos lugares de conocimiento y explotar por completo mis habilidades en el ambito tecnologico y social.
                    Me gustan los retos y romper estandares, por ello nunca se me hace dificulta trabajar bajo presión, más sin embargo me gusta tener todo en orden y llevar un seguimiento optimo a cada uno de mis proyectos con el fin de que sean resueltos de manera exitosa.
                    ¡Gracias por leer acerca de mí!
                </p>
              </div>
              
        </div>
    </section>
    {{-- Seccion para el contenido del curriculum, en este van todo lo referente a el --}}
    <section id="curriculum" class="section transform hover:scale-105 transition-transform duration-500" >
        <div class="title" id="curriculum">
            <h2 class="text-5xl text-center" style="margin-top: 13px; margin-bottom: 13px;">
                <span class="text-cyan-700">CURRI</span> 
                <span class="text-gray-800">CULUM</span>
            </h2>
            <div class="flex justify-center ">
                <img src="./img/CV_CESAR.png" width="1000" height="1900" class="img-hover">
            </div>
        </div>
    </section>
    <br><br>
    {{-- Seccion para el contenido multimedia donde estan las imagenes y videos --}}
    <section id="multimedia" class="section">
        <div class="title">
            <h2 class="text-5xl text-center" style="margin-top: 13px; margin-bottom: 13px;">
                <span class="text-gray-800">MULTI</span> 
                <span class="text-cyan-700">MEDIA</span>
            </h2>
            <div class="carousel relative">
                <!-- Diapositivas -->
                <div class="carousel-inner">
                  <!-- Imágenes -->
                  <div class="carousel-item">
                    <img src="./img/futbol.jpg" width="200" height="200" alt="Imagen 1">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/tirolesa1.jpg" width="200" height="200" alt="Imagen 2">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/tirolesa2.jpg" width="200" height="200" alt="Imagen 1">
                  </div>
                  <div class="carousel-item">
                    <img src="./img/grupo.jpg" width="200" height="200" alt="Imagen 2">
                  </div>

                  <!-- Videos -->
                  <div class="carousel-item">
                    <video controls>
                      <source src="./img/Battlefield.mp4" width="200" height="200" type="video/mp4">
                    </video>
                  </div>
                  <div class="carousel-item">
                    <video controls>
                      <source src="/img/EstructuraSimple.mp4" width="200" height="200" type="video/mp4">
                    </video>
                  </div>
                </div>
              
                <!-- Navegación -->
                <button class="carousel-prev absolute left-0 top-1/2 transform -translate-y-1/2">
                  Anterior
                </button>
                <button class="carousel-next absolute right-0 top-1/2 transform -translate-y-1/2">
                  Siguiente
                </button>
            </div>
        </div>
    </section>

    <section id="contact" class="section" >
        <div class="title transform hover:scale-105 transition-transform duration-500">
            <h2 class="text-5xl text-center" style="margin-top: 13px; margin-bottom: 13px;">
                <span class="text-cyan-700">CONT</span> 
                <span class="text-gray-800">ACTO</span>
            </h2>
            <div class="flex justify-center ">
                <img src="./img/of3.png" class="img-hover" width="600" height="600" style="border-radius: 10%; margin-top: 12px; margin-bottom: 12px;" >
            </div>
            <div class="max-w-4xl mx-auto">
                <H4 class="text-3xl text-center">Nuestras oficinas</H4>
                <div class="container text-lg" id="contacto">
                    <p>
                        <i class="fas fa-map-marker-alt text-2xl"></i> <b class="text-cyan-900"> Dirección:</b> 39 y 40 Doblado, Col. Cuauhtémoc N° 2254, CP: 87078.
                    </p>
                    <p>
                        <i class="fab fa-whatsapp text-2xl"></i> <b class="text-cyan-900"> Teléfono:</b> 8343077689
                    </p>
                    <p>
                        <i class="far fa-envelope text-2xl"></i><b class="text-cyan-900"> Correo electrónico:</b> 2030070@upv.edu.mx
                    </p>
                    <p>
                        <a href="https://www.facebook.com/cesar230802/" target="_blank"><i class="fab fa-facebook text-2xl"></i><b class="text-cyan-900"> Facebook:</b> César Flores </a>
                    </p>
                    <p>
                        <a href="https://www.instagram.com/cesarfloresgamez/" target="_blank"><i class="fab fa-instagram text-2xl"></i><b class="text-cyan-900"> Instagram:</b> cesarfloresgamez</a>
                    </p>
                </div>
            </div>   
        </div>    

        <div class="flex justify-center">
            <div class="map-responsive" id="mapContainer" style="margin-top: 17px; margin-bottom: 5px;">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d917.9104359396221!2d-99.176692864858!3d23.725835811753473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x867952d8f81b3fef%3A0xf53f273ac1636e30!2sDoblado%20LT8%2C%20Sector%20Upysset%2C%2087078%20Cd%20Victoria%2C%20Tamps.!5e0!3m2!1ses!2smx!4v1678680290673!5m2!1ses!2smx" width="900" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
          
    </section>
    <div class="flex justify-end">
        <a class="scroll-link top-link bg-cyan-500 hover:bg-cyan-700 text-white p-3 shadow-md rounded-lg transition-transform duration-300 hover:scale-110" href="#home">
          <i class="fas fa-arrow-up"></i>
        </a>
      </div>
      
           

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="./js/app_p3.js"></script>
@endsection
