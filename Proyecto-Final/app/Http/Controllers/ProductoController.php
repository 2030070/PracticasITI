<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }
    public function create()
    {
        $categorias = Categoria::all();
        
        $subcategorias = Subcategoria::all();
        return view('productos.create', compact('categorias','subcategorias'));
    }

    //Funcion que valida los elementos en la base de datos para la tabla de productos, se establecen requerimientos para algunos campos
    //Se envia el contenido a la base de datos mediante los campos y se crea el contenido
    public function store(Request $request){
        $request->validate([
            'categoria_id' => 'required',
            'subcategoria_id' => '',
            'nombre' =>'required|min:3',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'unidades_disponibles' => 'required|integer|min:0',
            'creado_por' => 'required',
        ]);

        Producto::create([
            'categoria_id' => $request->categoria_id,
            'subcategoria_id' => $request->subcategoria_id,
            'nombre' => $request->nombre,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $request->precio_venta,
            'unidades_disponibles' => $request->unidades_disponibles,
            'creado_por' => Auth::user()->name,
        ]);
        //redirecciona a la vista de productos para ver la tabla
        return redirect()->route('productos.show')->with('success', 'Producto creada correctamente.');
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();

        $subcategorias = Subcategoria::all();

        return view('productos.edit', compact('producto','categorias','subcategorias'));
    }

    //Manda los datos de la tabla productos a la vista show productos y pagina el contenido de 10 en 10
    public function show(){
        $productos = Producto::paginate(10);
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();

        return view('productos.show', ['productos' => $productos, 'categorias' => $categorias, 'subcategorias' => $subcategorias]);
    }

    //Elimina el contenido de la base de datos con ayuda del id del producto creado
    public function destroy($id){
        Producto::findOrFail($id)->delete();
        return redirect()->route('productos.show')->with('success', 'Producto eliminada correctamente.');
    }

    public function update(Request $request, $id){
        $request->validate([
            'categoria_id' => 'required',
            'subcategoria_id' => '',
            'nombre' =>'required',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'unidades_disponibles' => 'required|integer|min:0',
            'creado_por' => 'required',

        ]);

        $producto = Producto::findOrFail($id);
        $producto->categoria_id = $request->categoria_id;
        $producto->subcategoria_id = $request->subcategoria_id;
        $producto->nombre = $request->nombre;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->unidades_disponibles = $request->unidades_disponibles;
        $producto->creado_por = Auth::user()->name;
        $producto->save();

        return redirect()->route('productos.show')->with('actualizado', 'Producto actualizado correctamente.');
    }

}
