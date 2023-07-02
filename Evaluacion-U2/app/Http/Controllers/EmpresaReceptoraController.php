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
        //Validar para que no se repitan las razones sociales con el metodo slug
        $request->merge(['razon_social' => Str::slug($request->razon_social)]);

        //Validacion de los datos de la empresa emisora
        $this->validate($request,[
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'rfc' => 'required|string',
            'contacto' => 'required|string',
            'email' => 'required|email',
        ]);

        EmpresaReceptora::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'rfc' => $request->rfc,
            'contacto' => $request->contacto,
            'email' => $request->email,
        ]);
        

        return redirect()->route('empresas_receptoras.index')->with('success', 'Empresa emisora registrada exitosamente');
    }
}
