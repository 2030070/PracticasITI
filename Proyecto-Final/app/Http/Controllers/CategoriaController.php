<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Str;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoriaController extends Controller
{   
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }
    // Redirecciona a la vista para registrar la categoría
    public function create(){
        return view('categorias.create');
    }

    public function edit(Categoria $categoria){
        return view('categorias.edit', compact('categoria'));
    }

    public function store(Request $request){
        $request->merge(['codigo' => Str::slug($request->codigo)]);

        // Validación de los datos de la categoría
        $this->validate($request, [
            'imagen' => 'required', // Imagen requerida
            'codigo' => 'required|unique:categorias,codigo',
            'nombre' => 'required',
            'descripcion' => 'required',
            'creado_por' => 'required',
        ]);

        // Crear la nueva categoría utilizando el modelo
        Categoria::create([
            'imagen' => $request->imagen,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'creado_por' => Auth::user()->name,
        ]);

        // Redirigir a la vista de mostrar categorías
       
        return redirect()->route('categorias.show')->with('success', 'Categoría agregada correctamente');

    }

    // Manda los datos de la tabla categoria a la vista show categoria y pagina el contenido de 10 en 10    
    public function show(){
        $categorias = Categoria::all();
        return view('categorias.show')->with(['categorias' => $categorias]);
    }

    // Elimina el contenido de la base de datos con ayuda del id del producto creado
    public function destroy($id){
        $categoria = Categoria::findOrFail($id);
    
        // Encuentra todas las subcategorías que tienen una referencia a esta categoría
        $subcategorias = Subcategoria::where('categoria_id', $categoria->id)->get();
    
        // Recorre cada subcategoría y elimina la subcategoría
        foreach ($subcategorias as $subcategoria) {
            $subcategoria->delete();
        }

        // Encuentra todos los productos que tienen una referencia a esta categoría
        $productos = Producto::where('categoria_id', $categoria->id)->get();

        // Recorre cada producto y elimina el producto
        foreach ($productos as $producto) {
            $producto->delete();
        }
    
        // Eliminar la imagen asociada a la categoria
        Storage::disk('public')->delete('uploads/' . $categoria->imagen);
    

        // Ahora puedes eliminar la categoría
        $categoria->delete();
        return redirect()->route('categorias.show')->with('success', 'Categoria eliminada correctamente.');
    }
    


    // Actualiza la categoría en la base de datos
    public function update(Request $request, $id){
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'descripcion' => 'required',
            'creado_por' => 'required',
            'imagen' => 'required',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->imagen = $request->imagen;
        $categoria->nombre = $request->nombre;
        $categoria->codigo = $request->codigo;
        $categoria->descripcion = $request->descripcion;
        $categoria->creado_por = Auth::user()->name;
        $categoria->save();

        return redirect()->route('categorias.show')->with('actualizada', 'Categoría actualizada correctamente.');
    }

    // Método para actualizar la imagen de una categoria existente
    public function updateImagen(Request $request, Categoria $categoria){
        $request->validate([
            'imagen' => 'required|image|max:2048', // Imagen requerida y tamaño máximo de 2MB
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior
            Storage::disk('public')->delete('uploads/' . $categoria->imagen);

            // Procesar y almacenar la nueva imagen
            $imagenPath = $request->file('imagen')->store('uploads', 'public');
            $imagen = Image::make(public_path("storage/{$imagenPath}"))->fit(500, 500);
            $imagen->save();

            $categoria->imagen = $imagenPath;
            $categoria->save();

            // Redireccionar a la vista de mostrar categoria con un mensaje de éxito
            return redirect()->route('categorias.show')->with('success', 'Imagen de categoria actualizada exitosamente.');
        }

        // Redireccionar a la vista de mostrar categorias con un mensaje de error
        return redirect()->route('categorias.show')->with('error', 'Error al actualizar la imagen de categoria.');
    }

}

