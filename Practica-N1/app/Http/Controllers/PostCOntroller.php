<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostCOntroller extends Controller
{
    //Constructor para la protexion de la url "Dashboard"
    //Este es lo que se ejecuta cuando instanciamos un controlador
    public function __construct(){
        //Protegemos la url
        //al metodo index con el contructor le pasamos el parametro de autenticación 
        
        $this->middleware('auth');

    }

    //clase que me redireccione al dashboad
    public function index(){
        //Aplicar helper para revisar el usuario autenticado
        // dd(auth()->user());

        //Muestra la vista del dashboard
        return view('dashboard');

    }
}
