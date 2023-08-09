<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
            'imagen' => 'required', // Imagen requerida
            'categoria_id' => 'required',
            'codigo' => 'required|unique:subcategorias,codigo',
            'nombre' => 'required',
            'descripcion' => 'required',
            'creado_por' => 'required',
        ]);

        Subcategoria::create([
            'imagen' => $request->imagen,
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
            'imagen' => 'required',
            'categoria_id' => 'required',
            'codigo' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'creado_por' => 'required',
        ]);

       $subcategoria = Subcategoria::findOrFail($id);
       $subcategoria->imagen = $request->imagen;
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
        $subcategoria = Subcategoria::findOrFail($id);
    
        // Encuentra todos los productos que tienen una referencia a esta subcategoría
        $productos = Producto::where('subcategoria_id', $subcategoria->id)->get();
    
        // Recorre cada producto y elimina el producto
        foreach ($productos as $producto) {
            $producto->delete();
        }

        // Eliminar la imagen asociada a la categoria
        Storage::disk('public')->delete('uploads/' . $subcategoria->imagen);

        // Ahora puedes eliminar la subcategoría
        $subcategoria->delete();
        return redirect()->route('subcategorias.show')->with('success', 'Subcategoría eliminada correctamente.');
    }


    // Método para actualizar la imagen de una subcategorias existente
    public function updateImagen(Request $request, Subcategoria $subcategoria){
        $request->validate([
            'imagen' => 'required|image|max:2048', // Imagen requerida y tamaño máximo de 2MB
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior
            Storage::disk('public')->delete('uploads/' . $subcategoria->imagen);

            // Procesar y almacenar la nueva imagen
            $imagenPath = $request->file('imagen')->store('uploads', 'public');
            $imagen = Image::make(public_path("storage/{$imagenPath}"))->fit(500, 500);
            $imagen->save();

            $subcategoria->imagen = $imagenPath;
            $subcategoria->save();

            // Redireccionar a la vista de mostrar subcategoria con un mensaje de éxito
            return redirect()->route('subcategorias.show')->with('success', 'Imagen de categoria actualizada exitosamente.');
        }

        // Redireccionar a la vista de mostrar subcategorias con un mensaje de error
        return redirect()->route('subcategorias.show')->with('error', 'Error al actualizar la imagen de categoria.');
    }
}
