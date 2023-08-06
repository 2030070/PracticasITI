<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cliente; // Asegúrate de importar el modelo Cliente

class VentaController extends Controller
{
    public function __construct(){
        // Proteger las rutas del controlador con autenticación
        $this->middleware('auth');
    }
    // Redirecciona a la vista para registrar una venta
    public function create(Request $request) {
        $clientes = Cliente::all();
        $categorias = Categoria::all();
        $productos = Producto::query();
    
        // Filtrar por categoría si se selecciona una en el formulario
        if ($request->has('categoria_id')) {
            $categoriaId = $request->input('categoria_id');
            $productos->where('categoria_id', $categoriaId);
        }
    
        $productos = $productos->get();

        if ($request->has('product')) {
            $producto = json_decode($request->input('product'), true);
            $precio = $request->input('price');
            $imagen = $request->input('imagen');
            $venta = [
                'producto_id' => $producto['id'],
                'nombre_producto' => $producto['nombre'],
                'precio' => $precio,
                'cantidad' => 1, // Puedes cambiar la cantidad inicial según tus necesidades
                'subtotal' => $precio,
                'imagen' => $imagen,
            ];

            Session::push('carrito', $venta);
        }
        
    
        return view('ventas.create', compact('clientes', 'categorias', 'productos'));
    }
    
    public function store(Request $request)
    {
        // Validar los datos recibidos desde el cliente si es necesario
        $request->validate([
            'fecha' => 'required|date',
            'nombre_cliente' => 'required|string|max:255',
            'referencia' => 'required|string|max:255',
            'estatus' => 'required|string|max:255',
            'pago' => 'required|numeric',
            'total' => 'required|numeric',
            'pago_parcial' => 'required|numeric',
            'pago_pendiente' => 'required|numeric',
            'creado_por' => 'required|string|max:255',
            'productos' => 'required|array', // Asegúrate de que 'productos' sea un array
        ]);

        // Crear una nueva instancia del modelo Venta y asignar los datos recibidos del cliente.
        $venta = new Venta();
        $venta->fecha = $request->fecha;
        $venta->nombre_cliente = $request->nombre_cliente;
        $venta->referencia = $request->referencia;
        $venta->estatus = $request->estatus;
        $venta->pago = $request->pago;
        $venta->total = $request->total;
        $venta->pago_parcial = $request->pago_parcial;
        $venta->pago_pendiente = $request->pago_pendiente;
        $venta->creado_por = $request->creado_por;

        // Guardar la venta en la base de datos
        $venta->save();

        // Ahora, para guardar los productos de la venta, podemos iterar a través de los productos recibidos del cliente y asociarlos a la venta recién creada.
        foreach ($request->productos as $producto) {
            $venta->productos()->attach($producto['id'], ['cantidad' => $producto['quantity']]);
        }

        // Si todo es exitoso, podemos enviar una respuesta JSON al cliente.
        return response()->json(['message' => 'Venta guardada con éxito'], 200);
    }

    // Muestra los datos de la tabla ventas en la vista show ventas, paginando el contenido de 10 en 10
    public function show(){
        // Cargar el nombre del cliente asociado con cada venta
        $ventas = Venta::all();
        return view('ventas.show', compact('ventas'));
    }
}
