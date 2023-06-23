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

    /*Funcion para eliminar un post en donde se elimina el contenido existente, y redirecciona a la pagina
    principal del usuario 'muro' del usuario logueado en ese momento
    */
    public function destroy(posts $post){
        $post->delete();

        //Eliminar la imagen 
        $imagen_path = public_path('uploads/' . $post->imagen );
        if(File::exists($imagen_path)){
            unlink($imagen_path);

        }

        return redirect()->route('post_index',auth()->user()->username);
    }
}


