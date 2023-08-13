<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cotizacion;
use App\Models\Marca;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $marcas = Marca::all();
        $subcategorias = Subcategoria::all();
        // Obtenemos todos los productos
        $todosLosProductos = Producto::all();
        // Pasamos todos los clientes a la vista
        $clientes = Cliente::all();
        return view('cotizaciones.create', compact('marcas','subcategorias','clientes', 'categorias', 'todosLosProductos'));
    }

        public function cart(){
            $carrito = session()->get('carrito', []);
            return response()->json(['cart' => $carrito]);
        }

    public function agregar(Request $request){   
        $producto_id = $request->get('producto_id');
        $producto = Producto::find($producto_id);

        if(!$producto) {
            return response()->json(['message' => 'Producto no encontrado.'], 404);
        }

        $carrito = session()->get('carrito', []);
        $key = array_search($producto_id, array_column($carrito, 'producto_id'));
        if($key !== false) {
            $carrito[$key]['cantidad']++;
        } else {
            $carrito[] = [
                'producto_id' => $producto_id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio_venta,
                'imagen' => $producto->imagen,
                'cantidad' => 1,
            ];
        }

        session()->put('carrito', $carrito);
        return response()->json(['cart' => $carrito]);
    }

    public function eliminar(Request $request){
        $producto_id = $request->get('producto_id');
        $carrito = session()->get('carrito', []);
        $key = array_search($producto_id, array_column($carrito, 'producto_id'));
        if($key === false) {
            return response()->json(['message' => 'Producto no encontrado en el carrito.'], 404);
        }
        unset($carrito[$key]);
        // Re-indexar el array después de eliminar un elemento
        $carrito = array_values($carrito);
        session()->put('carrito', $carrito);
        return response()->json(['cart' => $carrito]);
    }

    public function almacenarCotizacion(Request $request){
        // Iniciar una transacción
        DB::beginTransaction();
        try {
            // Obtener el cliente a partir del correo
            $cliente = Cliente::where('correo', $request->correo_cliente)->first();
            $cotizacion = new Cotizacion();
            // Asignar la fecha actual a fecha_cotizacion
            $cotizacion->fecha_cotizacion = Carbon::now();
            $cotizacion->cliente_id = $cliente->id;
            $cotizacion->total = $request->total;
            $cotizacion->referencia = $request->referencia;
            $cotizacion->status = 'terminado';
            $cotizacion->descripcion = 'Cotización realizada';
            $cotizacion->impuestos = $request->impuestos;
            $cotizacion->subtotal = $request->subtotal;
            // Debemos guardar la cotizacion antes de asociarle productos
            $cotizacion->save();
            $cotizacionId = $cotizacion->id;

            // Obtenemos los productos del carrito de la sesión
            $carrito = session()->get('carrito', []);

            // Recorremos cada producto y lo asociamos a la cotizacion
            foreach ($carrito as $producto) {
                $producto_id = $producto['producto_id'];
                $productoEnInventario = Producto::find($producto_id);
                $cotizacion->productos()->attach($producto_id,['cantidad' => $producto['cantidad'],'precio_unitario'=>$productoEnInventario['precio_venta'],'subtotal'=>$productoEnInventario['precio_venta']*$producto['cantidad']]);
                $productoEnInventario->save();
            }
            // Limpiamos el carrito de la sesión después de guardar la cotizacion
            session()->forget('carrito');
            // Todo salió bien, podemos hacer commit a la transacción
            DB::commit();
            return redirect()->route('cotizaciones.show')->with('success', 'Cotizacion registrada exitosamente');
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

