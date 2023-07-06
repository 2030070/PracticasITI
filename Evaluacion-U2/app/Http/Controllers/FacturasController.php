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
        // dd($request->all());
        // Validar los campos del formulario de creación de facturas
        
        // dd($request->validate([
        //     'empresa_emisora' => 'required',
        //     'empresa_receptora' => 'required',
        //     'folio_factura' => 'required',
        //     'pdf_file' => 'required',
        //     'xml_file' => 'required',
        // ]));
        
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
        // Obtener todas las facturas desde la base de datos
        // $facturas = Factura::all();
        // Retornar la vista para ver las facturas
        // return view('facturas.index', compact('facturas'));
        $facturas = Factura::paginate(10);
        return view('facturas.index', compact('facturas'));
    }

    public function consultarView(){
        return view('facturas.consultar');
    }

    public function buscarFacturas(Request $request)
    {
        $razonSocial = $request->input('razon_social');
        $rfc = $request->input('rfc');
        $nombre = $request->input('nombre');
        $folio = $request->input('folio');

        // Realiza la lógica de búsqueda de facturas según los parámetros recibidos

        // Por ejemplo, puedes consultar las facturas en base a los filtros
        $facturas = Factura::when($razonSocial, function ($query, $razonSocial) {
            $query->whereHas('empresaReceptora', function ($query) use ($razonSocial) {
                $query->where('id', $razonSocial);
            });
        })
        ->when($rfc, function ($query, $rfc) {
            $query->whereHas('empresaReceptora', function ($query) use ($rfc) {
                $query->where('rfc', $rfc);
            });
        })
        ->when($nombre, function ($query, $nombre) {
            $query->whereHas('empresaReceptora', function ($query) use ($nombre) {
                $query->where('nombre', 'like', '%' . $nombre . '%');
            });
        })
        ->when($folio, function ($query, $folio) {
            $query->where('folio_factura', $folio);
        })
        ->get();
        // Obtener las empresas receptoras para poblar el select de "Razón Social"
        $empresasReceptoras = EmpresaReceptora::all();

        // Retornar la vista con las facturas encontradas y las empresas receptoras
        return view('facturas.busqueda', compact('facturas', 'empresasReceptoras'));
    }
}
