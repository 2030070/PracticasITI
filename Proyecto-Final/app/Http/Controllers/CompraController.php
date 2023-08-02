<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function __construct(){
        // Proteger las rutas del controlador con autenticación
        $this->middleware('auth');
    }

    // Redirecciona a la vista para registrar una compra
    public function create(){
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('compras.create', compact('proveedores', 'productos'));
    }

    public function edit(Compra $compra){
        // Cargar el nombre del proveedor asociado con la compra
        $proveedores = Proveedor::all();
        $productos = Producto::all();
        return view('compras.edit', compact('compra', 'proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        $request->merge(['referencia' => Str::slug($request->referencia)]);

        // Validación de los datos de la compra
        $this->validate($request, [
            'nombre_producto' => 'required',
            'nombre_proveedor' => 'required',
            'referencia' => 'required|unique:compras,referencia',
            'fecha' => 'required',
            'estatus' => 'required',
            'total' => 'required|numeric',
            'pagado' => 'nullable|numeric',
            'pendiente_de_pago' => 'nullable|numeric',
            'estatus_de_pago' => 'required',
            'creado_por' => 'required',
        ]);

        // Crear la nueva compra utilizando el modelo
        Compra::create([
            'nombre_producto' => $request->nombre_producto,
            'nombre_proveedor' => $request->nombre_proveedor,
            'referencia' => $request->referencia,
            'fecha' => $request->fecha,
            'estatus' => $request->estatus,
            'total' => $request->total,
            'pagado' => $request->pagado,
            'pendiente_de_pago' => $request->pendiente_de_pago,
            'estatus_de_pago' => $request->estatus_de_pago,
            'creado_por' => Auth::user()->name,
        ]);

        // Redirigir a la vista de mostrar compras
        return redirect()->route('compras.show')->with('success', 'Compra agregada correctamente');
    }

    // Muestra los datos de la tabla compras en la vista show compras, paginando el contenido de 10 en 10
    public function show(){
        // Cargar el nombre del proveedor asociado con cada compra
        $compras = Compra::all();
        return view('compras.show', compact('compras'));
    }

    // Elimina una compra de la base de datos utilizando su ID
    public function destroy($id){
        Compra::findOrFail($id)->delete();
        return redirect()->route('compras.show')->with('success', 'Compra eliminada correctamente');
    }

    // Actualiza una compra en la base de datos
    public function update(Request $request, $id){
        $request->validate([
            'nombre_producto' => 'required',
            'nombre_proveedor' => 'required',
            'referencia' => 'required',
            'fecha' => 'required',
            'estatus' => 'required',
            'total' => 'required|numeric',
            'pagado' => 'nullable|numeric',
            'pendiente_de_pago' => 'nullable|numeric',
            'estatus_de_pago' => 'required',
        ]);

        $compra = Compra::findOrFail($id);
        $compra->nombre_producto = $request->nombre_producto;
        $compra->nombre_proveedor = $request->nombre_proveedor;
        $compra->referencia = $request->referencia;
        $compra->fecha = $request->fecha;
        $compra->estatus = $request->estatus;
        $compra->total = $request->total;
        $compra->pagado = $request->pagado;
        $compra->pendiente_de_pago = $request->pendiente_de_pago;
        $compra->estatus_de_pago = $request->estatus_de_pago;
        $compra->save();

        return redirect()->route('compras.show')->with('actualizada', 'Compra actualizada correctamente');
    }
}
