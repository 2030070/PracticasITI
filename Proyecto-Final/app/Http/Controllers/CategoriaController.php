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

class CategoriaController extends Controller{
    // El constructor del controlador establece que las rutas solo estarán disponibles para usuarios autenticados
    public function __construct(){
        $this->middleware('auth');
    }

    // Método que redirecciona a la vista para registrar una nueva categoría
    public function create(){
        return view('categorias.create');
    }

    // Método que redirecciona a la vista para editar una categoría existente
    public function edit(Categoria $categoria){
        return view('categorias.edit', compact('categoria'));
    }

    // Método que almacena una nueva categoría en la base de datos
    public function store(Request $request){
        // Genera un slug a partir del código ingresado en el formulario
        $request->merge(['codigo' => Str::slug($request->codigo)]);

        // Realiza validación de los datos ingresados en el formulario
        $this->validate($request, [
            'imagen' => 'required',
            'codigo' => 'required|unique:categorias,codigo',
            'nombre' => 'required|min:3',
            'descripcion' => 'required|min:5',
            'creado_por' => 'required',
        ]);

        // Crea una nueva categoría en la base de datos utilizando el modelo Categoria
        Categoria::create([
            'imagen' => $request->imagen,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'creado_por' => Auth::user()->name,
        ]);

        // Redirige a la vista que muestra las categorías con un mensaje de éxito
        return redirect()->route('categorias.show')->with('success', 'Categoría agregada correctamente');
    }

    // Método que muestra todas las categorías paginadas en la vista
    public function show(){
        $categorias = Categoria::all();
        return view('categorias.show')->with(['categorias' => $categorias]);
    }

    // Método que elimina una categoría y sus subcategorías y productos relacionados
    public function destroy($id){
        // Encuentra la categoría a eliminar por su ID
        $categoria = Categoria::findOrFail($id);

        // Encuentra y elimina las subcategorías relacionadas
        $subcategorias = Subcategoria::where('categoria_id', $categoria->id)->get();
        foreach ($subcategorias as $subcategoria) {
            $subcategoria->delete();
        }

        // Encuentra y elimina los productos relacionados
        $productos = Producto::where('categoria_id', $categoria->id)->get();
        foreach ($productos as $producto) {
            $producto->delete();
        }

        // Elimina la imagen asociada a la categoría desde el sistema de almacenamiento
        Storage::disk('public')->delete('uploads/' . $categoria->imagen);

        // Finalmente, elimina la categoría
        $categoria->delete();

        // Redirige a la vista de categorías con un mensaje de éxito
        return redirect()->route('categorias.show')->with('success', 'Categoría eliminada correctamente.');
    }

    // Método que actualiza los datos de una categoría existente
    public function update(Request $request, $id){
        // Realiza validación de los datos ingresados en el formulario de actualización
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'descripcion' => 'required|min:3',
            'creado_por' => 'required|min:3',
            'imagen' => 'required',
        ]);

        // Encuentra la categoría a actualizar por su ID
        $categoria = Categoria::findOrFail($id);

        // Actualiza los campos de la categoría con los datos ingresados
        $categoria->imagen = $request->imagen;
        $categoria->nombre = $request->nombre;
        $categoria->codigo = $request->codigo;
        $categoria->descripcion = $request->descripcion;
        $categoria->creado_por = Auth::user()->name;
        $categoria->save();

        // Redirige a la vista de categorías con un mensaje de éxito
        return redirect()->route('categorias.show')->with('actualizada', 'Categoría actualizada correctamente.');
    }

    // Método para actualizar la imagen de una categoría existente
    public function updateImagen(Request $request, Categoria $categoria){
        // Realiza validación de la imagen ingresada
        $request->validate([
            'imagen' => 'required|image|max:2048', // Imagen requerida y tamaño máximo de 2MB
        ]);

        // Procesa y almacena la nueva imagen
        if ($request->hasFile('imagen')) {
            // Elimina la imagen anterior
            Storage::disk('public')->delete('uploads/' . $categoria->imagen);
            // Procesa y almacena la nueva imagen
            $imagenPath = $request->file('imagen')->store('uploads', 'public');
            $imagen = Image::make(public_path("storage/{$imagenPath}"))->fit(500, 500);
            $imagen->save();

            // Actualiza la ruta de la imagen en la categoría
            $categoria->imagen = $imagenPath;
            $categoria->save();

            // Redirige a la vista de categorías con un mensaje de éxito
            return redirect()->route('categorias.show')->with('success', 'Imagen de categoría actualizada exitosamente.');
        }

        // Redirige a la vista de categorías con un mensaje de error si la actualización de la imagen falla
        return redirect()->route('categorias.show')->with('error', 'Error al actualizar la imagen de categoría.');
    }
}
