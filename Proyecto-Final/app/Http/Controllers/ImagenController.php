<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;

/* Controlador para las imágenes que contiene la función 'Store' */
class ImagenController extends Controller{
    // Método para almacenar una imagen en el servidor
    public function store(Request $request)
    {
        $imagen = $request->file('file'); // Obtener la imagen del formulario
        $nombreImagen = Str::uuid() . "." . $imagen->extension(); // Generar un nombre único para la imagen

        $imagenServidor = Image::make($imagen); // Crear una instancia de la imagen utilizando Intervention Image
        $imagenServidor->fit(1000, 1000); // Redimensionar la imagen para que tenga un tamaño máximo de 1000x1000 píxeles

        $imagenPath = public_path('uploads') . '/' . $nombreImagen; // Ruta donde se guardará la imagen en el servidor
        $imagenServidor->save($imagenPath); // Guardar la imagen en el servidor

        return response()->json(['imagen' => $nombreImagen]); // Devolver el nombre de la imagen como respuesta en formato JSON
    }

    public function update(Request $request)
    {
        // Obtener la imagen del formulario
        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);

        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }


    // Método para mostrar una imagen en la vista de detalle de una marca
    // public function index($id)
    // {
    //     $marca = Marca::find($id); // Obtener la marca según su ID
    //     $creadoPor = User::where('id', $marca->creado_por)->value('name'); // Obtener el nombre del usuario que creó la marca
    //     return view('marcas.show', ['marca' => $marca, 'creadoPor' => $creadoPor]); // Mostrar la vista de detalle de la marca con la información correspondiente
    // }
}
