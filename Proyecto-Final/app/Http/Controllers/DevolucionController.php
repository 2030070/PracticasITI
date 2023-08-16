<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Devolucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DevolucionController extends Controller{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }

    //Redirecciona a la vista para registrar las devoluciones
    public function create($producto,$venta){
        // Obtener la cantidad de un producto específico en la venta

        $venta = Venta::where('id',$venta)->first();
        $producto = Producto::withTrashed()->where('id',$producto)->first();

        $cantidadProductoEnVenta = $venta->productos()
        ->where('producto_id', $producto->id)
        ->first()
        ->pivot
        ->cantidad;

        $devoluciones = Devolucion::where([
            'producto_id' => $producto->id,
            'venta_id' => $venta->id,
        ])->get();

        $totalCantidad = $devoluciones->sum('cantidad');
        $cantidadMaxima = $cantidadProductoEnVenta - $totalCantidad;
        $fechaActual = date('Y-m-d');

        if($cantidadMaxima == 0){
            return redirect()->back()->with('error', 'Ya se han devuelto todos los productos de este tipo');
        }
        //Obtener el nombre de los camposcantidadProductoEnVenta
        return view('devoluciones.create',compact('fechaActual','producto','venta','cantidadMaxima'));
    }

    //metodo para editar el formulario
    public function edit(Devolucion $devolucion){
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('devoluciones.edit', compact('devolucion','clientes','productos'));

    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'fecha_devolucion' => 'required|date',
            'descripcion' => 'required|string',
            'referencia' => 'required|string',
            'cantidad' => 'required|integer|min:1',
            'producto_id' => 'required|exists:productos,id',
            'creado_por' => 'required|string',
            'venta_id' => 'required'
        ]);

        // Crear una nueva instancia de Devolucion con los datos validados
        $devolucion = new Devolucion([
            'venta_id' => $validatedData['venta_id'],
            'fecha_devolucion' => $validatedData['fecha_devolucion'],
            'descripcion' => $validatedData['descripcion'],
            'referencia' => $validatedData['referencia'],
            'cantidad' => $validatedData['cantidad'],
            'producto_id' => $validatedData['producto_id'],
            'creado_por' => $validatedData['creado_por'],
        ]);

        // Guardar la devolución en la base de datos
        $devolucion->save();

        return redirect()->route('devoluciones.show');
    }



    //Manda los datos de la tabla devoluciones a la vista show devoluciones y pagina el contenido de 10 en 10
    public function show(){
        $devoluciones = Devolucion::all();
        return view('devoluciones.show',  ['devoluciones' => $devoluciones]);
    }

    //Elimina el contenido de la base de datos con ayuda del id del producto creado
    public function destroy($id){
        Devolucion::findOrFail($id)->delete();
        return redirect()->route('devoluciones.show')->with('success', 'Devolución eliminada correctamente.');
    }

    // Actualiza la información de una devolución específica
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_producto' => 'required',
            'fecha_devolucion' => 'required',
            'cliente' => 'required',
            'estatus' => 'required',
            'precio_total' => 'required|numeric|min:0',
            'pagado' => 'required|numeric|min:0',
            'adeudo' => 'required|numeric|min:0',
            'estatus_pago' => 'required',
            'creado_por' => 'required',
        ]);
        //guardado de datos en el formulario
        $devolucion = Devolucion::findOrFail($id);
        $devolucion->nombre_producto = $request->nombre_producto;
        $devolucion->fecha_devolucion = $request->fecha_devolucion;
        $devolucion->cliente = $request->cliente;
        $devolucion->estatus = $request->estatus;
        $devolucion->precio_total = $request->precio_total;
        $devolucion->pagado = $request->pagado;
        $devolucion->adeudo = $request->adeudo;
        $devolucion->estatus_pago = $request->estatus_pago;
        $devolucion->creado_por = Auth::user()->name;
        $devolucion->save();

        // Redirecciona a la vista de devoluciones para ver la tabla
        return redirect()->route('devoluciones.show')->with('actualizada', 'Devolución actualizado correctamente.');
    }

}
