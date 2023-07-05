<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        // Validar para que no se repitan las razones sociales con el método slug
        $request->merge(['codigo' => Str::slug($request->codigo)]);

        // Validación de los datos de la categoría
        $this->validate($request, [
            'codigo' => 'required|unique:categorias,codigo',
            'descripcion' => 'required',
            'creado_por' => 'required',
        ]);

        // Crear la nueva categoría utilizando el modelo
        Categoria::create([
            'codigo' => $request->codigo,
            'descripcion' => $request->descripcion,
            'creado_por' => $request->creado_por,
        ]);

        // Redirigir a la vista de mostrar categorías
        return redirect()->route('categorias.show');
    }

    public function show()
    {
        $categorias = Categoria::paginate(10);
        return view('categorias.show', ['categorias' => $categorias]);
    }

    public function destroy($id)
    {
        Categoria::findOrFail($id)->delete();
        return redirect()->route('post_index');
    }
}

