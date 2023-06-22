<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comentario;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* Controlador del los modelo Comentario en el cual es requerido los modelos de User y Post para las diversas funciones
    que nos retornaran a la vista indicada y el contenido que sea necesario enviar para mostrar en las views
    aqui se usan las funciones 'Store', para validar, almacenar e imprimir el contenido del modelo
*/
class ComentarioController extends Controller{
    public function store(Request $request, User $user , posts $post){
         // Validar
         $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);
        
        // Almacenar
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        // Imprimir un mensaje 
        // return back()->with('mensaje', 'Comentario publicado correctamente');

        /* Se retorna la a la vista de show.blade.php donde se muestra el post y es requerido el 
           username para saber quien publico tal comentario
        */
        return redirect()->route('posts.show',[
            auth()->user()->username,
            'post'=>$post,
        ]);
    }
}
