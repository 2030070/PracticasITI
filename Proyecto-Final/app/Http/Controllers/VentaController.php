<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Subcategoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Cliente; // Asegúrate de importar el modelo Cliente

class VentaController extends Controller{
    public function __construct(){
        // Proteger las rutas del controlador con autenticación
        $this->middleware('auth');
    }

    public function showDetalleVenta(Venta $venta){
        return redirect('detalleVenta',compact('venta'));
    }

    // Muestra el form para crear una nueva cotización
    public function create(){
        // pasamos todas las categorias a la vista
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $subcategorias = Subcategoria::all();
        $todosLosProductos = Producto::all();
        $clientes = Cliente::all();
        $fechaActual = date('Y-m-d');
        return view('ventas.create', compact('fechaActual','marcas','subcategorias','clientes', 'categorias', 'todosLosProductos'));
    }

    public function store(Request $request){
        // Iniciar una transacción
        DB::beginTransaction();
        try {
            // Obtener el cliente a partir del correo
            $cliente = Cliente::where('correo', $request->correo_cliente)->first();
            $venta = new Venta();

            // Asignar la fecha actual a fecha_cotizacion
            $venta->fecha = $request->fecha;
            $venta->cliente_id = $cliente->id;
            $venta->creado_por = Auth::user()->id;
            $venta->total = $request->total;
            $venta->referencia = $request->referencia;
            $venta->pago = $request->pago;

            // Verificar que el pago sea suficiente
            if ($venta->pago < $venta->total) {
                return back()->with('error','Pago insuficiente');
            }

            // Debemos guardar la venta antes de asociarle productos
            $venta->save();

            $ventaId = $venta->id;

            // Obtenemos los productos del carrito de la sesión
            $carrito = session()->get('carrito', []);

            // Recorremos cada producto y lo asociamos a la venta
            foreach ($carrito as $producto) {
                $producto_id = $producto['producto_id'];
                $cantidad = $producto['cantidad'];
                $productoEnInventario = Producto::find($producto_id);

                $venta->productos()->attach(
                    $producto_id,
                    ['cantidad' => $cantidad]
                );
                $productoEnInventario->unidades_disponibles -= $cantidad;
                $productoEnInventario->save();
            }

            // Limpiamos el carrito de la sesión después de guardar la venta
            session()->forget('carrito');

            // Todo salió bien, podemos hacer commit a la transacción
            DB::commit();

            return Redirect::route('ventas.show');
        } catch (\Exception $e) {
            DB::rollBack();
            error_log($e->getMessage());
            return back()->with('error',$e->getMessage());
        }

    }

    public function filtro(Request $request){
        $filtros = $request->all();
        $productos = Producto::query();

        if(isset($filtros['categoria_id'])) {
            $productos->where('categoria_id', $filtros['categoria_id']);
        }

        if(isset($filtros['subcategoria_id'])) {
            $productos->where('subcategoria_id', $filtros['subcategoria_id']);
        }

        if(isset($filtros['marca_id'])) {
            $productos->where('marca_id', $filtros['marca_id']);
        }

        if(isset($filtros['nombre'])) {
            $productos->where('nombre', 'LIKE', '%'.$filtros['nombre'].'%');
        }

        $productos = $productos->get();
        return response()->json(['productos' => $productos]);
    }

    // Muestra los datos de la tabla ventas en la vista show ventas, paginando el contenido de 10 en 10
    public function show(){
        // Cargar el nombre del cliente asociado con cada venta
        $ventas = Venta::all();
        return view('ventas.show', compact('ventas'));
    }

    // Elimina una compra de la base de datos utilizando su ID
    public function destroy($id){
        Venta::findOrFail($id)->delete();
        return redirect()->route('ventas.show')->with('success', 'Venta eliminada correctamente');
    }
}
