<?php

namespace App\Http\Controllers;

use App\Models\EmpresaEmisora;
use App\Models\EmpresaReceptora;
use App\Models\Factura;
use Illuminate\Http\Request;

class BuscarFacturaController extends Controller
{
    //
    // El método consultarView() se encarga de cargar la vista inicial para la consulta de facturas. Dentro de este método, se obtienen todas las 
    // facturas ($facturas), todas las empresas emisoras ($empresasEmisoras), y todas las empresas receptoras ($empresasReceptoras) usando los modelos correspondientes.
    public function consultarView(){
        $facturas = Factura::all();
        $empresasEmisoras = EmpresaEmisora::all();
        $empresasReceptoras = EmpresaReceptora::all();
        return view('facturas.consultar', compact('facturas','empresasEmisoras','empresasReceptoras'));
    }

    // El método buscarFacturas() se encarga de procesar la solicitud de búsqueda de facturas. Se espera que la solicitud contenga los siguientes campos: 
    // 'razon_social', 'rfc', 'nombre' y 'folio'. Estos campos se validan utilizando la función validate() 
    public function buscarFacturas(Request $request){
        $request->validate([
            'razon_social' => 'required',
            'rfc' => 'required',
            'nombre' => 'required',
            'folio' => 'nullable',
        ]);

        // La consulta se construye utilizando el método query() para obtener una instancia del objeto de consulta y luego se encadenan las condiciones de búsqueda utilizando el método where(). 
        // El método when() se utiliza para agregar una condición adicional en caso de que el campo 'folio' esté presente en la solicitud.
        $facturas = Factura::query()
        ->where('empresa_emisora_id', $request->razon_social)
        ->where('empresa_receptora_id', $request->rfc)
        ->where('empresa_receptora_id', $request->nombre)
        ->when($request->folio, function ($query) use ($request) {
            return $query->where('folio_factura', $request->folio);
        })
        ->get();
        
        //Una vez que se obtienen las facturas que coinciden con los criterios de búsqueda, se cargan todas las empresas emisoras 
        //y receptoras utilizando los modelos correspondientes.
        $empresasEmisoras = EmpresaEmisora::all();
        $empresasReceptoras = EmpresaReceptora::all();
        
        if ($facturas) {
            // Factura encontrada, mostrar mensaje de éxito
            session()->flash('success', $facturas);
        } else {
            // Factura no encontrada, mostrar mensaje de error
            session()->flash('error');
        }

        //retorno a la vista de cosnultas con el contenido compacto para ser utilizado en la vista
        return view('facturas.consultar', compact('facturas', 'empresasEmisoras', 'empresasReceptoras'));
    }
}
