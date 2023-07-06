<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* Controlador del dashboard donde retorna al contenido de la ventana principal*/
class DashboardController extends Controller{
    //Se retorna a la vista del login para que sea la principal del sitio web
    public function inicio() {
        return view('auth.login');
    }
}
