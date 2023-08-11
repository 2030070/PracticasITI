<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use App\Models\Marca;
use App\Models\Cliente;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{

    public function index(){
        $ventas = Venta::all();
        return view('ventas.index',compact('ventas'));
    }

    public function form(Request $request)
    {

        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $marcas = Marca::all();
        $productos = Producto::query();
        $productos = $productos->get();

        return view('ventas.create', compact('productos', 'categorias', 'subcategorias', 'marcas'));
    }

    public function agregar(Request $request)
{
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

public function eliminar(Request $request)
{
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

public function cart()
{
    $carrito = session()->get('carrito', []);

    return response()->json(['cart' => $carrito]);
}

    public function store(Request $request)
    {
        // Iniciar una transacción
        DB::beginTransaction();
        try {
            // Obtener el cliente a partir del correo
            $cliente = Cliente::where('correo', $request->correo_cliente)->first();

            if (!$cliente) {
                return back()->with('error', 'No se encontró un cliente con ese correo.');
            }

            $venta = new Venta();

            // Asignar la fecha actual a fecha_venta
            $venta->fecha_venta = Carbon::now();
            $venta->cliente_id = $cliente->id;
            $venta->estatus = "terminada"; // Valor predeterminado
            $venta->pago = "hecho";
            $venta->subtotal = $request->subtotal;
            $venta->descuento = 0; // Valor predeterminado
            $venta->impuestos = $request->impuestos;
            $venta->total = $request->total;
            $venta->pago_monto = $request->pago;
            $venta->vendedor_id = auth()->user()->id;

            // Verificar que el pago sea suficiente
            if ($venta->pago_monto < $venta->total) {
                $venta->estatus = "pendiente"; // Valor predeterminado
                $venta->pago = "pendiente";
            }

            // Debemos guardar la venta antes de asociarle productos
            $venta->save();

            // Obtenemos los productos del carrito de la sesión
            $carrito = session()->get('carrito', []);

            // Recorremos cada producto y lo asociamos a la venta
            foreach ($carrito as $producto) {
                $producto_id = $producto['producto_id'];
                $productoEnInventario = Producto::find($producto_id);
                if(!$productoEnInventario) {
                    throw new \Exception('El producto con ID '.$producto_id.' no se encontró en el inventario.');
                }
                if($producto['cantidad'] > $productoEnInventario->unidades_disponibles) {
                    throw new \Exception('El producto '.$productoEnInventario->nombre.' solo tiene '.$productoEnInventario->unidades_disponibles.' unidades disponibles.');
                }
                $venta->products()->attach($producto_id, ['cantidad' => $producto['cantidad']]);
                $productoEnInventario->unidades_disponibles -= $producto['cantidad'];
                $productoEnInventario->save();
            }

            // Limpiamos el carrito de la sesión después de guardar la venta
            session()->forget('carrito');

            // Todo salió bien, podemos hacer commit a la transacción
            DB::commit();

            return redirect()->route('ventas.index')->with('success','Venta registrada exitosamente');
        } catch (\Exception $e) {
            // Algo salió mal, debemos hacer rollBack a la transacción
            DB::rollBack();
            // Imprimir o registrar el mensaje de error para depuración
            error_log($e->getMessage());
            return back()->with('error',$e->getMessage());
        }

    }

    public function filtro(Request $request)
    {
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

        if ($productos->isEmpty()) {
            return response()->json(['error' => 'No se encontraron productos con los filtros proporcionados.']);
        }

        return response()->json(['productos' => $productos]);
    }


    public function show($ventaId)
    {
        $venta = Venta::find($ventaId);

        if (!$venta) {
            abort(404); // Mostrar página de error 404 si no se encuentra la venta.
        }

        return view('ventas.show', ['venta' => $venta]);
    }

    public function destroy(Venta $venta)
{
    try {
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    } catch (\Exception $e) {
        return redirect()->route('ventas.index')->with('error', 'Ocurrió un error al eliminar la venta.');
    }
}

}

