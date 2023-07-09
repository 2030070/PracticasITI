<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevolucionController extends Controller
{
    //Redirecciona a la vista para registrar las devoluciones
    public function create(){
        return view('devoluciones.create');
    }

    // Almacenar la informacion sobre la devolucion del producto
    public function store(Request $request){
        
        $request->validate([
            'nombre_producto' => 'required',
            'fecha_devolucion' => 'required',
            'cliente' =>'required',
            'estatus' => 'required',
            'precio_total' => 'required|numeric|min:0',
            'pagado' => 'required|numeric|min:0',
            'adeudo' => 'required|numeric|min:0',
            'estatus_pago' => 'required',
            'creado_por' => 'required',
        ]);

        Devolucion::create([
            'nombre_producto' => $request->nombre_producto,
            'fecha_devolucion' => $request->fecha_devolucion,
            'cliente' => $request->cliente,
            'estatus' => $request->estatus,
            'precio_total' => $request->precio_total,
            'pagado' => $request->pagado,
            'adeudo' => $request->adeudo,
            'estatus_pago' => $request->estatus_pago,
            'creado_por' => Auth::user()->name,
        ]);
        //redirecciona a la vista de devoluciones para ver la tabla
        $nombreUsuario = Auth::user()->name;
        return redirect()->route('devoluciones.show', ['nombreUsuario' => $nombreUsuario]);
    }

    //Manda los datos de la tabla devoluciones a la vista show devoluciones y pagina el contenido de 10 en 10
    public function show(){
        $devoluciones = Devolucion::paginate(10);
        return view('devoluciones.show',  ['devoluciones' => $devoluciones]);
    }

    //Elimina el contenido de la base de datos con ayuda del id del producto creado
    public function destroy($id){
        Devolucion::findOrFail($id)->delete();
        return redirect()->route('devoluciones.show');
    }
}
