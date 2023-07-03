<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmpresaEmisora;

class EmpresaEmisoraController extends Controller{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $empresaEmisoras = EmpresaEmisora::all();
        return view('empresa_emisora.index', ['empresaEmisora' => $empresaEmisoras]);
    }


    public function create(){
        return view('empresa_emisora.create');
    }

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
