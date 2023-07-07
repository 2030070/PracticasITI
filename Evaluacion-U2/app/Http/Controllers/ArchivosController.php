<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Routing\Controller;

class ArchivosController extends Controller{

      //Constructor para validar usuario autenticado
      public function __construct(){
        // Verifica que el usuario esté autenticado
        // 'auth' es el middleware de autenticación en Laravel
        // El middleware se ejecuta antes de los métodos del controlador
        $this->middleware('auth');
    }

    // Función para almacenar el archivo PDF
    public function storePDF(Request $request){
        $pdf = $request->file('file');
        // Se obtiene el nombre original del archivo
        $nombrepdf = $pdf->getClientOriginalName();
        // Se define el path en donde queremos almacenar el archivo
        $pdfPath = public_path('uploads') . '/' . $nombrepdf;
        // Se copia el archivo a la ruta establecida
        copy($pdf, $pdfPath);

        // Se devuelve una respuesta JSON con el nombre del archivo PDF almacenado
        return response()->json(['pdf' => $nombrepdf]);
    }

    // Función para almacenar archivos XML
    public function storeXML(Request $request){
        $xml = $request->file('file');
        // Se obtiene el nombre original del archivo
        $nombrexml = $xml->getClientOriginalName();
        // Se define el path en donde queremos almacenar el archivo
        $xmlPath = public_path('uploads') . '/' . $nombrexml;
        // Se copia el archivo a la ruta establecida
        copy($xml, $xmlPath);

        // Se devuelve una respuesta JSON con el nombre del archivo XML almacenado
        return response()->json(['xml' => $nombrexml]);
    }

    // Función para descargar archivos
    public function download($file){
        $pathFile = public_path('uploads').'/'.$file;
        // Se genera una respuesta de descarga del archivo
        return response()->download($pathFile);
    }
}