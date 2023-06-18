<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function index(User $user){
        //oobtenemos los post de publicacion del usuario
        // $posts = Auth::user()->post;
        $posts = Post::where('user_id', $user->id)->paginate(8);
        //Aplicar helper para revisar el usuario autenticado

        // pasamos los valores de los post de publicacion hacia la vista
        return view('dashboard',[
            'user'=>$user,
            'posts'=>$posts,
        ]);

    }
    // creando metodo para formulario de publicaciones
    // Crear un formulario para crear publicaciónes, boton de publicar, con un boton
    public function create(){
        // return view('auth.create');
        return view('posts.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'titulo' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);
        //Crear las publicaciónes
        // Post::create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user->id,
        // ]);

        // crear las publicaciones y guardar a traves de relaciónes (Entidad-Relación)
        //Post es el nombre de la relación 
        $request->user()->post()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('post_index',auth()->user()->username);
    }
}
