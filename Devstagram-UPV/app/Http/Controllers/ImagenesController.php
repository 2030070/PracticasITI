<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenesController extends Controller
{
    public function store(Request $request){
        // identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');
        //convertimos un arreglo input a formato en Json
        // return response()->json(['imagen'=>$imagen->extension()]);
        //GENERAR UN ID UNICO PARA CADA UNA DE LAS IMAGENES QUE SE CARGAN AL SERVER
        $nombreImagen = Str::uuid() . ".". $imagen->extension();
        
        //Implementar intervention image
        $imagenServidor = Image::make($imagen);

        //agregamos efectos de intervention image
        $imagenServidor->fit(1000,1000);

        //movemos la imagen a un lugar fisico del server
        $imagenPath = public_path('uploads').'/'.$nombreImagen;

        //Pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);


        //verificar que el nombre del archivo se ponga como unico
        return response()->json(['imagen'=>$nombreImagen]);
    }
    //
}
