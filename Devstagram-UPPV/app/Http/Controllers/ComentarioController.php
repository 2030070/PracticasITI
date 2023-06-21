<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comentario;
use App\Models\posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioController extends Controller
{
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
        return redirect()->route('posts.show',[
            auth()->user()->username,
            'post'=>$post,
        ]);
    }
}
