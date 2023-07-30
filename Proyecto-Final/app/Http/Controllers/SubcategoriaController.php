<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoriaController extends Controller{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }

    public function create(){
        $categorias = Categoria::all();
        return view('subcategorias.create', compact('categorias'));
    }

    /**
     * Almacenar una nueva subcategoría en la base de datos.
     */
    public function store(Request $request){
        $request->validate([
            'categoria_id' => 'required',
            'codigo' => 'required|unique:subcategorias,codigo',
            'nombre' => 'required',
            'descripcion' => 'required',
            'creado_por' => 'required',
        ]);

        Subcategoria::create([
            'categoria_id' => $request->categoria_id,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'creado_por' => Auth::user()->name,
        ]);

        return redirect()->route('subcategorias.show')->with('success', 'Subcategoría creada correctamente.');
    }
    /**
     * Mostrar la subcategoría especificada.
     */
    public function show(){
        $subcategorias = Subcategoria::all();
        return view('subcategorias.show', compact('subcategorias'));
    }

    /**
     * Mostrar el formulario para editar una subcategoría existente.
     */
    public function edit(Subcategoria $subcategoria){
        $categorias = Categoria::all();
        return view('subcategorias.edit', compact('subcategoria', 'categorias'));
    }

    /**
     * Actualizar la subcategoría especificada en la base de datos.
     */
    public function update(Request $request, $id){
        $request->validate([
            'categoria_id' => 'required',
            'codigo' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'creado_por' => 'required',
        ]);

       $subcategoria = Subcategoria::findOrFail($id);
       $subcategoria->categoria_id = $request->categoria_id;
       $subcategoria->codigo = $request->codigo;
       $subcategoria->nombre = $request->nombre;
       $subcategoria->descripcion = $request->descripcion;
       $subcategoria->creado_por = Auth::user()->name;
       $subcategoria->save();
       

        return redirect()->route('subcategorias.show')->with('success', 'Subcategoría actualizada correctamente.');
    }

    /**
     * Eliminar la subcategoría especificada de la base de datos.
     */
    public function destroy($id){
        Subcategoria::findOrFail($id)->delete();
        return redirect()->route('subcategorias.show')->with('success', 'Subcategoría eliminada correctamente.');
    }
}
