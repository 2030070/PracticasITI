<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Controlador para cerrar sesión, utiliza el metodo 'Store' el cual cierra la sesión y retorna a la vista  
    del login
*/
class LogoutController extends Controller{

    public function store() {
        //cerrar sesion con el helper out implementando elmetodo logout
        auth()->logout();
        //enviar la vista del login
        return redirect()->route('login');
    }
    
}
