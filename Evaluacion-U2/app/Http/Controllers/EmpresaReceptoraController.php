<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmpresaReceptora;

class EmpresaReceptoraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $empresaReceptoras = EmpresaReceptora::all();
        return view('empresa_receptora.index', ['empresaReceptora' => $empresaReceptoras]);
    }


    public function create(){
        return view('empresa_receptora.create');
    }

    public function store(Request $request){
        //Validar para que no se repitan los rfc con el metodo slug
        $request->merge(['rfc' => Str::slug($request->rfc)]);

        //Validacion de los datos de la empresa emisora
        $this->validate($request,[
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'rfc' => 'required|string|unique:empresas_receptoras,rfc',
            'contacto' => 'required|string',
            'email' => 'required|email',
        ]);

        //Con el modelo manda los datos necesarios para crear una nueva empresa receptora con todos los campos requeridos 
        EmpresaReceptora::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'rfc' => $request->rfc,
            'contacto' => $request->contacto,
            'email' => $request->email,
        ]);
        
        //retorna a la visra para ver el contenido en tablas
        return redirect()->route('empresas_receptoras.index')->with('success', 'Empresa emisora registrada exitosamente');
    }
}
