<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    //constructor para proteccion de la url 'dashboard'
    //el constructor es lo que se ejectira cuando instancias un controlador

    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth')->except(['show','index']);
    }
    public function index(User $user)
    {
        // Obtener los posts de publicación del usuario paginados
        $posts = posts::where('user_id', $user->id)->paginate(4);
    
        // Retornar a la vista con el username y los posts de publicación
        return view('dashboard', ['user' => $user, 'posts' => $posts]);
    }
    //creando  create para formulario de publicaciones
    public function create() {
        return view('posts.create');
    }

    public function store(Request $request) {
        //validaciones del formulario de registros
        $this->validate($request,[
            //Reglas de validacion 
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required',
        ]);

        //guradra los campos en el modelo posts
        /*posts::create([
            'titulo'=>$request->titulo,
            'descripcion'=>$request->descripcion,
            'imagen'=>$request->imagen,
            //identificamos el usuario autenticado
            'user_id'=>auth()->user()->id,

            
        ]);*/

        //guardar registro con relaciones(E-R)
        //"post" es el nombre de la relacion
        $request->user()->post()->create([
            'titulo'=>$request->titulo,
            'descripcion'=>$request->descripcion,
            'imagen'=>$request->imagen,
            //identificamos el usuario autenticado
            'user_id'=>Auth::id(),
        ]);

        //redireccionamiento
        return redirect()->route('post_index',auth()->user()->username);

        
    }
    public function show(User $user,posts $post){

        return view('posts.show',[
            'post'=>$post,
        ]);
    }
    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }
}


