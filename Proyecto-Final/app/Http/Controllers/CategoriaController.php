<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    //Redirecciona a la vista para registrar la categoria
    public function create(){
        return view('categorias.create');
    }

    public function store(Request $request){
        // Validar para que no se repitan las razones sociales con el método slug
        $request->merge(['codigo' => Str::slug($request->codigo)]);

        // Validación de los datos de la categoría
        $this->validate($request, [
            'codigo' => 'required|unique:categorias,codigo',
            'nombre' => 'required',
            'descripcion' => 'required',
            'creado_por' => 'required',
        ]);

        // Crear la nueva categoría utilizando el modelo
        Categoria::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'creado_por' => Auth::user()->name,
        ]);

        // Redirigir a la vista de mostrar categorías
        $nombreUsuario = Auth::user()->name;
        return redirect()->route('categorias.show', ['nombreUsuario' => $nombreUsuario]);

    }

    //Manda los datos de la tabla categoria a la vista show categoria y pagina el contenido de 10 en 10    
    public function show($nombreUsuario){
        $categorias = Categoria::paginate(10);
        return view('categorias.show', ['categorias' => $categorias, 'nombreUsuario' => $nombreUsuario]);
    }
    

     //Elimina el contenido de la base de datos con ayuda del id del producto creado
    public function destroy($id){
        Categoria::findOrFail($id)->delete();
        return redirect()->route('post_index');
    }
}

