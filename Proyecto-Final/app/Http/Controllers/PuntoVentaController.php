<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use DB; // Agregamos el uso de la clase DB para usar consultas personalizadas

class PuntoVentaController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $categorias = Categoria::all();
        $productosSeleccionados = [];
        $total = 0;

        return view('ventas.puntoVenta', compact('productosSeleccionados', 'total', 'productos', 'categorias'));
    }

    public function guardarCompra(Request $request)
    {
        // Obtener el ID del usuario autenticado
        $userId = Auth::user()->id;

        // Obtener la fecha actual y asignarla al campo 'fecha'
        $fechaActual = date('Y-m-d');

        // Generar una referencia aleatoria única para 'referencia_venta'
        $referenciaVenta = Str::random(10);

        // Obtener el valor del campo 'pago_venta'
        $pagoVenta = $request->input('pago_venta');

        // Obtener el valor del campo 'total_venta'
        $totalVenta = $request->input('total_venta');

        $ivaVenta = $totalVenta * 0.16;

        $subtotalVenta = $totalVenta - $ivaVenta;

        // Calcular el campo 'pagado_venta' según el valor de 'pago_venta' y 'total_venta'
        $pagadoVenta = ($pagoVenta == $totalVenta) ? 'pagado' : 'debe';

        // Calcular el campo 'deuda_venta' como la resta entre 'total_venta' y 'pago_venta'
        $deudaVenta = (floatval($pagoVenta) - floatval($totalVenta));

        // Valor por defecto para 'vendedor'
        $vendedor = 'admin';

        // Crear una nueva instancia del modelo Venta y asignar los valores calculados y del formulario
        $venta = new Venta();
        $venta->user_id = $userId;
        $venta->fecha = $fechaActual;
        $venta->referencia_venta = $referenciaVenta;
        $venta->estado_venta = $request->input('estado_venta');
        $venta->pago_venta = $pagoVenta;
        $venta->total_venta = $totalVenta;
        $venta->iva = $ivaVenta;
        $venta->subtotal = $subtotalVenta;
        $venta->pagado_venta = $pagadoVenta;
        $venta->deuda_venta = $deudaVenta;
        $venta->vendedor = $vendedor;

        // Guardar la venta en la base de datos
        $venta->save();

        // Guardar la relación entre la venta y los productos vendidos
        $productosSeleccionadosList = json_decode($request->input('productos_seleccionados'));
        foreach ($productosSeleccionadosList as $productoSeleccionado) {
            $producto = Producto::findOrFail($productoSeleccionado->id);
            $venta->productos()->attach($producto->id, ['cantidad' => $productoSeleccionado->cantidad]);

            // Actualizar la cantidad de productos disponibles en la tabla 'productos'
            $cantidadVendida = $productoSeleccionado->cantidad;
            $producto->unidades_disponible -= $cantidadVendida;
            $producto->save();
        }
        //Mandar a la vista de Punto de Venta
        return redirect()->route('puntoVenta.index')->with('success', 'Venta guardada correctamente');
    }

    public function destroy($id){
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->back()->with('success','Se borró la venta');
    }

    public function showDetalleVenta($id)
    {
        $ventas = Venta::findOrFail($id);
        // Obtener la venta por su ID junto con los detalles de los productos vendidos usando JOIN
        $producto = Venta::select('ventas.*', 'productos.nombre as nombre_producto', 'productos.imagen as imagen_producto', 'productos.precio_venta as precio_producto', 'producto_venta.cantidad as cantidad_vendida')
            ->join('producto_venta', 'ventas.id', '=', 'producto_venta.venta_id')
            ->join('productos', 'productos.id', '=', 'producto_venta.producto_id')
            ->where('ventas.id', $id)
            ->get();

        // Pasar los datos a la vista detalleVenta.blade.php
        return view('ventas.detalleVenta',['ventas'=>$ventas], compact('producto'));
    }
}

