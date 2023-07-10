<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function create(){
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $marcas = Marca::all(); // Obtener todas las marcas

        return view('productos.create', compact('categorias', 'subcategorias', 'marcas'));
    }

    public function store(Request $request){
        $request->validate([
            'categoria_id' => 'required',
            'subcategoria_id' => '',
            'marca_id' => '', // Validación opcional para la marca_id
            'nombre' => 'required|min:3',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'unidades_disponibles' => 'required|integer|min:0',
            'creado_por' => 'required',
        ]);

        Producto::create([
            'categoria_id' => $request->categoria_id,
            'subcategoria_id' => $request->subcategoria_id,
            'marca_id' => $request->marca_id, // Asignar la marca_id recibida en el formulario
            'nombre' => $request->nombre,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $request->precio_venta,
            'unidades_disponibles' => $request->unidades_disponibles,
            'creado_por' => Auth::user()->name,
        ]);

        return redirect()->route('productos.show')->with('success', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto){
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $marcas = Marca::all(); // Obtener todas las marcas

        return view('productos.edit', compact('producto', 'categorias', 'subcategorias', 'marcas'));
    }

    public function show(){
        $productos = Producto::paginate(10);
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();

        return view('productos.show', ['productos' => $productos, 'categorias' => $categorias, 'subcategorias' => $subcategorias]);
    }

    public function destroy($id){
        Producto::findOrFail($id)->delete();

        return redirect()->route('productos.show')->with('success', 'Producto eliminado correctamente.');
    }

    public function update(Request $request, $id){
        $request->validate([
            'categoria_id' => 'required',
            'subcategoria_id' => '',
            'marca_id' => '', // Validación opcional para la marca_id
            'nombre' => 'required',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'unidades_disponibles' => 'required|integer|min:0',
            'creado_por' => 'required',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->categoria_id = $request->categoria_id;
        $producto->subcategoria_id = $request->subcategoria_id;
        $producto->marca_id = $request->marca_id; // Asignar la marca_id recibida en el formulario
        $producto->nombre = $request->nombre;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->unidades_disponibles = $request->unidades_disponibles;
        $producto->creado_por = Auth::user()->name;
        $producto->save();

        return redirect()->route('productos.show')->with('actualizado', 'Producto actualizado correctamente.');
    }

}
