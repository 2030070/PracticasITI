<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmpresaEmisora;

class EmpresaEmisoraController extends Controller{
    /**
     * Display a listing of the resource.
     */

     //Funcion para retoranar a la vista del listado de empresas emisoras
    public function index(){
        //Paginación a 10 elementos
        $empresaEmisoras = EmpresaEmisora::paginate(10);
        //Envio de datos y retorno a la vista
        return view('empresa_emisora.index', ['empresaEmisora' => $empresaEmisoras]);
    }

    //Vista para crear el registro de la empresa emisora
    public function create(){
        return view('empresa_emisora.create');
    }

    //Funcion para la validación de datos de la empresa emisora donde se autentican y redirecciona a la ventana del listado de las empresas
    public function store(Request $request){
        //Validar para que no se repitan las razones sociales con el metodo slug
        $request->merge(['razon_social' => Str::slug($request->razon_social)]);
        $request->merge(['rfc_emisor' => Str::slug($request->rfc_emisor)]);

        //Validacion de los datos de la empresa emisora
        $this->validate($request,[
            'razon_social' => 'required|unique:empresas_emisoras,razon_social',
            'correo_contacto' => 'required|email|unique:empresas_emisoras,correo_contacto',
            'rfc_emisor' => 'required|unique:empresas_emisoras,rfc_emisor'
        ]);
        //Con el modelo manda los datos necesarios para crear una nueva empresa emisora con todos los campos requeridos 
        EmpresaEmisora::create([
            'razon_social' => $request->razon_social,
            'correo_contacto' => $request->correo_contacto,
            'rfc_emisor' => strtoupper($request->rfc_emisor),
        ]);
        
        //retorna la vista para ver el contenido en tablas
        return redirect()->route('empresas_emisoras.index')->with('success', 'Empresa emisora registrada exitosamente');
    }
}
