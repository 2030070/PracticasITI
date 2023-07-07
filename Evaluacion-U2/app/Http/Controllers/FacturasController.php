<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmpresaEmisora;
use App\Models\EmpresaReceptora;

class FacturasController extends Controller{

    public function create(){
        // Se obtienen todas las empresas emisoras
        $empresasEmisoras = EmpresaEmisora::all();
        // Se obtienen todas las empresas receptoras
        $empresasReceptoras = EmpresaReceptora::all();
        // Retornar la vista para crear facturas
        return view('facturas.create', compact('empresasEmisoras'), compact('empresasReceptoras'));
    }

    public function store(Request $request){
        
        //Validacion de los datos de la tabla facturas
        $request->validate([
            'empresa_emisora' => 'required',
            'empresa_receptora' => 'required',
            'folio_factura' => 'required',
            'pdf_file' => 'required',
            'xml_file' => 'required',
        ]);

        // Crear una nueva factura en la base de datos
        Factura::create([
            'empresa_emisora_id' => $request->empresa_emisora,
            'empresa_receptora_id' => $request->empresa_receptora,
            'folio_factura' => $request->folio_factura,
            'pdf_file' => $request->pdf_file,
            'xml_file' => $request->xml_file,
        ]);

        // // Redireccionar a la página de visualización de facturas
        return redirect()->route('facturas.index')->with('success', 'La factura se ha creado exitosamente.');
    }

    //Retorna a la vista de la tabla facturas
    public function index(){
        // Obtener todas las facturas desde la base de datos y paginar el contenido
        $facturas = Factura::paginate(10);
        // Retornar la vista para ver las facturas
        return view('facturas.index', compact('facturas'));
    }
    
     //Elimina el contenido de la base de datos con ayuda del id del producto creado
    public function destroy($id){
        Factura::findOrFail($id)->delete();
        return redirect()->route('facturas.index');
    }

}
