<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

/* Controlador que maneja todo el contenido de los post en ellos se usan los modelos de post y user
    Asi mimo se utiliza un constructor para pasar parametros autenticados, el metodo 'index'
    el cual retorna a la vista dashboard y pasa los parametros de usuario y los post e implementa la painación
    el metodo create para redireccionar al formulario que crea el post, también contiene el metodo 'Store'
    donde se valida, guarda y manda los campos a la vista
    y 'Show'retorna a la vista del show donde muestra el contenido del post y se pasa el parametro del mismo
*/
class PostController extends Controller{
    //constructor para proteccion de la url 'dashboard'
    //el constructor es lo que se ejectira cuando instancias un controlador

    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth')->except(['show','index']);
    }
    public function index(User $user){
    
        // Retornar a la vista con el username y los posts de publicación
        return view('dashboard');
    }

}


