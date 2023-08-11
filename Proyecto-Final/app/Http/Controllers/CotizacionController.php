<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cotizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CotizacionController extends Controller
{
    // Muestra la tabla de Cotizaciones realizadas
    public function mostrarCotizaciones(){
        $cotizaciones = Cotizacion::all();
        return view('cotizaciones.show', compact('cotizaciones'));
    }

    // Muestra el form para crear una nueva cotización
    public function crearCotizacion(){
        // pasamos todas las categorias a la vista
        $categorias = Categoria::all();
        // Obtenemos todos los productos
        $todosLosProductos = Producto::all();
        // Pasamos todos los clientes a la vista
        $clientes = Cliente::all();
        return view('cotizaciones.create', compact('clientes', 'categorias', 'todosLosProductos'));
    }
    // Metodo para hacer el filtrado de productos por categoria
    public function filtrarProductosCotizacion($categoriaId){
        // Obtener todas las categorias
        $categorias = Categoria::all();
        // Obtener los productos de la categoría seleccionada
        $productosfiltrados = Producto::where('id_categoria_producto', $categoriaId)->get();
        // Pasar los productosfiltrados filtrados a la vista
        return view('cotizaciones.create', compact('productosfiltrados', 'categorias'));
    }

    // Metodo para agregar un producto a la tabla // Recibe solo el id del producto y la accion (agregar o quitar)de cotizacion
    public function agregarProductoCotizacion(Request $request){
        $tabla = session()->get('tabla', []);
        $producto_id = $request->get('producto_id');
        $accion = $request->get('agregar');
        $cantidadVenta = (int)$request->get('cantidad_venta'); // Obtener el valor ingresado en el input como entero

        // Validamos si se recibe un add
        // Si se recibe un add, se agrega un producto al carrito
        if ($accion === 'add') {
            if (isset($tabla[$producto_id])) { // Si el producto ya existe en la tabla
                $producto = Producto::findOrFail($producto_id);

                // Validamos que si la cantidad ingresada es = a 0, regrese un mensaje de error
                if ($cantidadVenta === 0) {
                    return back()->with('mensaje', 'La cantidad ingresada no puede ser 0');
                }

                // Validamos que la cantidad ingresada no sea mayor a la cantidad en stock
                if ($cantidadVenta > $tabla[$producto_id]['cantidad']) {
                    return back()->with('mensaje', 'La cantidad ingresada no puede ser mayor a la cantidad en stock');
                }

                // Validamos que la suma de la cantidad ingresada y la cantidad en la tabla no sea mayor a la cantidad en stock
                if ($cantidadVenta + $tabla[$producto_id]['cantidad'] > $producto->unidades_disponibles) {
                    return back()->with('mensaje', 'La cantidad ingresada no puede ser mayor a la cantidad en stock');
                }

                $tabla[$producto_id]['cantidad'] += $cantidadVenta; // Aumentar la cantidad en la cantidad ingresada
            } else { // Si el producto no existe en la tabla
                $producto = Producto::findOrFail($producto_id);

                // Validamos que si la cantidad ingresada es = a 0, regrese un mensaje de error
                if ($cantidadVenta === 0) {
                    return back()->with('mensaje', 'La cantidad ingresada no puede ser 0');
                }

                // Validamos que la cantidad ingresada no sea mayor a la cantidad en stock
                if ($cantidadVenta > $producto->unidades_disponibles) {
                    return back()->with('mensaje', 'La cantidad ingresada no puede ser mayor a la cantidad en stock');
                }

                // Validamos que la cantidad ingresada no sea menor a 0
                if ($cantidadVenta < 0) {
                    return back()->with('mensaje', 'La cantidad ingresada no puede ser menor a 0');
                }

                // Agregar el producto a la tabla con la cantidad ingresada
                $tabla[$producto_id] = [
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio_venta,
                    'cantidad' => $cantidadVenta,
                    'imagen' => $producto->imagen,
                ];
            }

            session()->put('tabla', $tabla);
            return back();
        }
        // Si se recibe un less, se elimina un producto de la tabla de cotizacion
        elseif ($accion === 'less') {

            // Validar que la cantidad ingresada no sea menor a 1
            if ($cantidadVenta >= 1) {
                if (isset($tabla[$producto_id])) {
                    $tabla[$producto_id]['cantidad'] = $cantidadVenta; // Establecer la cantidad ingresada
                    session()->put('tabla', $tabla);
                    return back();
                }
            }
        }
    }


    // Metodo para eliminar el producto de la tabla
    public function eliminarProductoCotizacion(Request $request){
        // dd($producto_id);
        $tabla = session()->get('tabla', []);
        $producto_id = $request->get('producto_id');

        if (isset($tabla[$producto_id])) {
            unset($tabla[$producto_id]);
            session()->put('tabla', $tabla);
            return back();
        }
    }

    // Metodo para almacenar la cotizacion en la base de datos
    public function almacenarCotizacion(Request $request){
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'cliente_id' => 'required',
            'codigo_referencia' => 'nullable|string|max:255',
            'descripcion_cotizacion' => 'nullable|string', // Añadir esta regla de validación
            'subtotal' => 'required|numeric',
            'totalImpuestos' => 'required|numeric',
            'total' => 'required|numeric',
            'status_cotizacion' => 'required',
        ]);

        // Crear una nueva instancia de Cotizacion y asignar los valores del formulario
        $cotizacion = new Cotizacion();
        $cotizacion->fecha_cotizacion = $request->fecha;
        $cotizacion->cliente_id = $request->cliente_id;
        $cotizacion->referencia = $request->codigo_referencia;
        $cotizacion->descripcion = $request->descripcion_cotizacion;
        $cotizacion->subtotal = $request->subtotal;
        $cotizacion->impuestos = $request->totalImpuestos;
        $cotizacion->total = $request->total;
        $cotizacion->status = $request->status_cotizacion;

        // Guardar la cotización en la base de datos
        $cotizacion->save();

        // Obtener los productos seleccionados de la sesión
        $productosSeleccionados = session()->get('tabla', []);
        // Recorremos los productos seleccionados y los asociamos a la cotización en la tabla intermedia
        foreach ($productosSeleccionados as $producto_id => $producto) {
            // Buscamos el producto en la base de datos
            $productoModel = Producto::find($producto_id);
            // Asociamos el producto a la cotización en la tabla intermedia
            $cotizacion->productos()->attach($productoModel, [
                'cantidad' => $producto['cantidad'],
                'precio_unitario' => $producto['precio'],
                'subtotal' => $producto['cantidad'] * $producto['precio'],
            ]);
        }

        // Eliminamos los productos seleccionados de la sesión después de guardarlos en la tabla intermedia
        session()->forget('tabla');
        // Redireccionamos a la vista de cotizaciones
        return redirect()->route('mostrar-cotizaciones')->with('mensaje', 'Cotización creada correctamente');
    }

    // Metodo para actualizar el status de la cotizacion
    public function actualizarEstadoCotizacion(Request $request, $id){
        // Validar los datos del formulario
        $request->validate([
            'nuevo_estado' => 'required',
        ]);

        // Buscar la cotizacion en la base de datos
        $cotizacion = Cotizacion::findOrFail($id);
        // Actualizar el status de la cotizacion
        $cotizacion->status = $request->nuevo_estado;
        // Guardar los cambios en la base de datos
        $cotizacion->save();
        // Redireccionar a la vista de cotizaciones
        return redirect()->route('mostrar-cotizaciones')->with('mensaje', 'Status de la cotización actualizado correctamente');
    }
}

