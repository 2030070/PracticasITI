<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\posts;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request){
        // identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');
        //convertimos un arreglo input a formato en Json
        // return response()->json(['imagen'=>$imagen->extension()]);
        //GENERAR UN ID UNICO PARA CADA UNA DE LAS IMAGENES QUE SE CARGAN AL SERVER
        $nombreImagen = Str::uuid() . ".". $imagen->extension();
        
        //Implementar intervention image
        $imagenServidor = Image::make($imagen);

        //agregamos efectos de intervention image
        $imagenServidor->fit(1000,1000);

        //movemos la imagen a un lugar fisico del server
        $imagenPath = public_path('uploads').'/'.$nombreImagen;

        //Pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);


        //verificar que el nombre del archivo se ponga como unico
        return response()->json(['imagen'=>$nombreImagen]);
    }
    //
    public function index($id){
        // Obtener la imagen y los demás datos según el ID
        $post = posts::find($id);
        // Obtener el nombre de usuario del post
        $username = User::where('id', $post->user_id)->value('username');
         // Obtener los comentarios relacionados al post
        $comentarios = Comentario::where('post_id', $post->id)->get(); 

        // Pasar los datos a la vista
        return view('posts.show', ['post' => $post, 'username' => $username, 'comentarios' => $comentarios]);
                    
    }
}
