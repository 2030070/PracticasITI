<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller{
    public function __construct(){
        // Proteger las rutas del controlador con autenticación
        $this->middleware('auth');
    }

    // Redirecciona a la vista para registrar una venta
    public function create(){
        return view('ventas.create');
    }

    public function edit(Venta $venta){
        return view('ventas.edit', compact('venta'));
    }

    public function store(Request $request){
        $request->merge(['referencia' => Str::slug($request->referencia)]);

        // Validación de los datos de la venta
        $this->validate($request, [
            'fecha' => 'required',
            'nombre_cliente' => 'required',
            'referencia' => 'required|unique:ventas,referencia',
            'estatus' => 'required',
            'pago' => 'required',
            'total' => 'required|numeric',
            'creado_por' => 'required',
        ]);

        // Crear la nueva venta utilizando el modelo
        Venta::create([
            'fecha' => $request->fecha,
            'nombre_cliente' => $request->nombre_cliente,
            'referencia' => $request->referencia,
            'estatus' => $request->estatus,
            'pago' => $request->pago,
            'total' => $request->total,
            'pago_parcial' => $request->pago_parcial,
            'pago_pendiente' => $request->pago_pendiente,
            'creado_por' => Auth::user()->name,
        ]);

        // Redirigir a la vista de mostrar ventas
        return redirect()->route('ventas.show')->with('success', 'Venta agregada correctamente');
    }

    // Muestra los datos de la tabla ventas en la vista show ventas, paginando el contenido de 10 en 10
    public function show()
    {
        $ventas = Venta::paginate(10);
        return view('ventas.show')->with(['ventas' => $ventas]);
    }

    // Elimina una venta de la base de datos utilizando su ID
    public function destroy($id)
    {
        Venta::findOrFail($id)->delete();
        return redirect()->route('ventas.show')->with('success', 'Venta eliminada correctamente');
    }

    // Actualiza una venta en la base de datos
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required',
            'nombre_cliente' => 'required',
            'referencia' => 'required',
            'estatus' => 'required',
            'pago' => 'required',
            'total' => 'required|numeric',
            'creado_por' => 'required',
        ]);

        $venta = Venta::findOrFail($id);
        $venta->fecha = $request->fecha;
        $venta->nombre_cliente = $request->nombre_cliente;
        $venta->referencia = $request->referencia;
        $venta->estatus = $request->estatus;
        $venta->pago = $request->pago;
        $venta->total = $request->total;
        $venta->pago_parcial = $request->pago_parcial;
        $venta->pago_pendiente = $request->pago_pendiente;
        $venta->creado_por = Auth::user()->name;
        $venta->save();

        return redirect()->route('ventas.show')->with('actualizada', 'Venta actualizada correctamente');
    }
}
