<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EmpresaEmisora;
use App\Models\EmpresaReceptora;

class FacturasController extends Controller{
    //
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }

    public function create(){
        // Se obtienen todas las empresas emisoras
        $empresasEmisoras = EmpresaEmisora::all();
        // Se obtienen todas las empresas receptoras
        $empresasReceptoras = EmpresaReceptora::all();
        // Retornar la vista para crear facturas
        return view('facturas.create', compact('empresasEmisoras'), compact('empresasReceptoras'));
    }

    public function store(Request $request){
        // dd($request->all());
        // Validar los campos del formulario de creación de facturas
        
        // dd($request->validate([
        //     'empresa_emisora' => 'required',
        //     'empresa_receptora' => 'required',
        //     'folio_factura' => 'required',
        //     'pdf_file' => 'required',
        //     'xml_file' => 'required',
        // ]));

        $request->validate([
            'empresa_emisora' => 'required',
            'empresa_receptora' => 'required',
            'folio_factura' => 'required',
            'pdf_file' => 'required',
            'xml_file' => 'required',
        ]);

        // // Crear una nueva factura en la base de datos
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

    public function index(){
        // Obtener todas las facturas desde la base de datos
        $facturas = Factura::all();
        // Retornar la vista para ver las facturas
        return view('facturas.index', compact('facturas'));
    }
}
