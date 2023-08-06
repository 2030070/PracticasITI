<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }
    
    // Método para mostrar el formulario de creación de marca
    public function create(){
        return view('marcas.create');
    }

    // Método para almacenar una nueva marca en la base de datos
    public function store(Request $request){
        $request->validate([
            'imagen' => 'required', // Imagen requerida
            'nombre' => 'required|max:255', // Nombre requerido y longitud máxima de 255 caracteres
            'descripcion' => 'required', // Descripción requerida
            'creado_por' => 'required', // Creado por requerido
        ]);

        // Crear una nueva marca en la base de datos con los datos proporcionados
        Marca::create([
            'imagen' => $request->imagen,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'creado_por' => Auth::user()->name,
        ]);

        // Obtener el nombre del usuario autenticado
        $nombreUsuario = Auth::user()->name;

        // Redireccionar a la vista de mostrar marcas con un mensaje de éxito
        return redirect()->route('marcas.show', ['nombreUsuario' => $nombreUsuario])->with('success', 'Marca creada exitosamente.');
    }

    // Método para mostrar todas las marcas
    public function show(){
        // Obtener una lista paginada de marcas (10 marcas por página)
        $marcas = Marca::all();
        return view('marcas.show', ['marcas' => $marcas]);
    }

    // Método para eliminar una marca existente de la base de datos
    public function destroy(Marca $marca){
        // Encuentra todos los productos que tienen una referencia a esta marca
        $productos = Producto::where('marca_id', $marca->id)->get();
    
        // Recorre cada producto y elimina el producto
        foreach ($productos as $producto) {
            $producto->delete();
        }
    
        // Eliminar la imagen asociada a la marca
        Storage::disk('public')->delete('uploads/' . $marca->imagen);
    
        // Eliminar la marca de la base de datos
        $marca->delete();
    
        // Redireccionar a la vista de mostrar marcas con un mensaje de éxito
        return redirect()->route('marcas.show')->with('success', 'Marca eliminada correctamente.');
    }

    // Método para mostrar el formulario de edición de una marca existente
    public function edit(Marca $marca){
        return view('marcas.edit', compact('marca'));
    }

    // Método para actualizar los datos de una marca existente en la base de datos
    public function update(Request $request, Marca $marca){
        $request->validate([
            'nombre' => 'required|max:255', // Nombre requerido y longitud máxima de 255 caracteres
            'descripcion' => 'required', // Descripción requerida
            'creado_por' => 'required', // Creado por requerido
            'imagen' => 'required',
        ]);

        // Actualizar los datos de la marca con los datos proporcionados
        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->creado_por = Auth::user()->name;
        $marca->imagen = $request->imagen;
        $marca->save();

        // Redireccionar a la vista de mostrar marcas con un mensaje de éxito
        return redirect()->route('marcas.show')->with('success', 'Marca actualizada exitosamente.');
    }

    // Método para actualizar la imagen de una marca existente
    public function updateImagen(Request $request, Marca $marca){
        $request->validate([
            'imagen' => 'required|image|max:2048', // Imagen requerida y tamaño máximo de 2MB
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior
            Storage::disk('public')->delete('uploads/' . $marca->imagen);

            // Procesar y almacenar la nueva imagen
            $imagenPath = $request->file('imagen')->store('uploads', 'public');
            $imagen = Image::make(public_path("storage/{$imagenPath}"))->fit(500, 500);
            $imagen->save();

            $marca->imagen = $imagenPath;
            $marca->save();

            // Redireccionar a la vista de mostrar marcas con un mensaje de éxito
            return redirect()->route('marcas.show')->with('success', 'Imagen de la marca actualizada exitosamente.');
        }

        // Redireccionar a la vista de mostrar marcas con un mensaje de error
        return redirect()->route('marcas.show')->with('error', 'Error al actualizar la imagen de la marca.');
    }
}
