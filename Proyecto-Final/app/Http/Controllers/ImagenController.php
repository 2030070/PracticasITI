<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marca;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Intervention\Image\Facades\Image;

/* COntrolador de las imagenes que contiene la funcion 'Store'*/
class ImagenController extends Controller{
    public function store(Request $request)
    {
        $imagen = $request->file('file');
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);

        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }

    public function index($id)
    {
        $marca = Marca::find($id);
        $creadoPor = User::where('id', $marca->creado_por)->value('name');
        return view('marcas.show', ['marca' => $marca, 'creadoPor' => $creadoPor]);
    }
}
