<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
/* Controlador del dashboard donde retorna al contenido de la ventana principal*/
class DashboardController extends Controller{

    
    // Método para mostrar la página de inicio (login)
    public function inicio() {
        return view('auth.login');
    }
    
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth')->except(['show','index']);
    }

    // Método para mostrar el contenido del dashboard
    public function index(User $user){
        // Retornar a la vista con el username y los posts de publicación
        return view('dashboard');
    }
}
