<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* Controlador del dashboard donde retorna al contenido de la ventana principal*/
class DashboardController extends Controller{

    public function inicio() {
        return view('auth.login');
    }
}
