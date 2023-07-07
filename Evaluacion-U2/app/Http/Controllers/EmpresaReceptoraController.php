<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmpresaReceptora;

class EmpresaReceptoraController extends Controller
{
     /**
      * Funccion para paginar el contenido de la tabla y el redireccionamiento de los campos totales para ser
      * utilizados en la vista de la tabla
      */
    public function index(){
        $empresaReceptoras = EmpresaReceptora::paginate(10);
        return view('empresa_receptora.index', ['empresaReceptora' => $empresaReceptoras]);
    }

    //Redireccionamiento a la vista para crear el registro de la empresa receptora
    public function create(){
        return view('empresa_receptora.create');
    }

    //Redireccionamiento con los campos validados y creados para ser guardados en la base de datos y observados en la vista 
    //del contenido en la tabla
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

    //elimina las empresas recepotras que fueron creadas mediante su id
    public function destroy($id){
        $empresaReceptora = EmpresaReceptora::findOrFail($id);
        // Eliminar la empresa receptora y las relaciones en cascada
        $empresaReceptora->facturas()->delete();
        $empresaReceptora->delete();
        return redirect()->route('empresas_receptoras.index')->with('success', 'Empresa receptora eliminada exitosamente.');
    }

}
