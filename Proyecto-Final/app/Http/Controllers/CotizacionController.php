<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    // Middleware para autenticación en todos los métodos del controlador
    public function __construct(){
        $this->middleware('auth');
    }

    // Método para mostrar el formulario de creación de producto
    public function create(){
        $productos = Producto::all(); // Obtener todas los productos
        $clientes = Cliente::all(); // Obtener todas los clientes
        
        return view('cotizaciones.create', compact('productos', 'clientes'));
    }

    // Método para almacenar un nuevo producto en la base de datos
    public function store(Request $request){
        $request->validate([
            'producto_id' => 'required', // Producto_id se traera todos los productos
            'referencia' => 'required', // Se crea la referencia para el producto
            'cliente_id' => '', // cliente id se traera todos los datos de clientes
            'estatus' => 'required', // Estatus
            'total_producto' => 'required|numeric|min:0', // Total producto se traera el total precio de compra
        ]);

        // Crear un nuevo producto en la base de datos con los datos proporcionados
        Cotizacion::create([
            'producto_id' => $request->producto_id,
            'referencia' => $request->referencia,
            'cliente_id' => $request->cliente_id, // Asignar la marca_id recibida en el formulario
            'estatus' => $request->estatus,
            'total_producto' => $request->total_producto,
        ]);

        // Redireccionar a la vista de mostrar productos con un mensaje de éxito
        return redirect()->route('cotizaciones.show')->with('success', 'Cotizacion creado correctamente.');
    }

    // Método para mostrar el formulario de edición de un producto existente
    public function edit(Cotizacion $cotizacion){
        $productos = Producto::all(); // Obtener todas los productos
        $clientes = Cliente::all(); // Obtener todas los clientes

        return view('cotizaciones.edit', compact('productos', 'clientes','cotizacion'));
    }

    // Método para mostrar todos los productos
    public function show(){
        $cotizaciones = Cotizacion::all(); // Obtener todas las cotizaciones

        return view('cotizaciones.show', ['cotizaciones' => $cotizaciones]);
    }

    // Método para eliminar un producto existente de la base de datos
    public function destroy($id){
        Cotizacion::findOrFail($id)->delete();
        // Redireccionar a la vista de mostrar productos con un mensaje de éxito
        return redirect()->route('cotizaciones.show')->with('success', 'Cotizacion eliminado correctamente.');
    }

    // Método para actualizar los datos de un producto existente en la base de datos
    public function update(Request $request, $id){
        $request->validate([
            'producto_id' => 'required', // Producto_id se traera todos los productos
            'referencia' => 'required', // Se crea la referencia para el producto
            'cliente_id' => '', // cliente id se traera todos los datos de clientes
            'estatus' => 'required', // Estatus
            'total_producto' => 'required|numeric|min:0', // Total producto se traera el total precio de compra
        ]);

        // Buscar el producto por su ID
        $cotizacion = Cotizacion::findOrFail($id);
        // Actualizar los datos del producto con los datos proporcionados
        $cotizacion->producto_id = $request->producto_id;
        $cotizacion->referencia = $request->referencia;
        $cotizacion->cliente_id = $request->cliente_id; // Asignar la marca_id recibida en el formulario
        $cotizacion->estatus = $request->estatus;
        $cotizacion->total_producto = $request->total_producto;
        $cotizacion->save();

        // Redireccionar a la vista de mostrar productos con un mensaje de éxito
        return redirect()->route('cotizaciones.show')->with('actualizada', 'Cotizacion actualizado correctamente.');
    }
}
