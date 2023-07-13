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
    // Middleware para autenticación en todos los métodos del controlador
    public function __construct(){
        $this->middleware('auth');
    }

    // Método para mostrar el formulario de creación de producto
    public function create(){
        $categorias = Categoria::all(); // Obtener todas las categorías
        $subcategorias = Subcategoria::all(); // Obtener todas las subcategorías
        $marcas = Marca::all(); // Obtener todas las marcas

        return view('productos.create', compact('categorias', 'subcategorias', 'marcas'));
    }

    // Método para almacenar un nuevo producto en la base de datos
    public function store(Request $request){
        $request->validate([
            'categoria_id' => 'required', // Categoría requerida
            'subcategoria_id' => '', // Subcategoría opcional
            'marca_id' => '', // Validación opcional para la marca_id
            'nombre' => 'required|min:3', // Nombre requerido y longitud mínima de 3 caracteres
            'precio_compra' => 'required|numeric|min:0', // Precio de compra requerido, numérico y valor mínimo de 0
            'precio_venta' => 'required|numeric|min:0', // Precio de venta requerido, numérico y valor mínimo de 0
            'unidades_disponibles' => 'required|integer|min:0', // Unidades disponibles requeridas, enteras y valor mínimo de 0
            'creado_por' => 'required', // Creado por requerido
        ]);

        // Crear un nuevo producto en la base de datos con los datos proporcionados
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

        // Redireccionar a la vista de mostrar productos con un mensaje de éxito
        return redirect()->route('productos.show')->with('success', 'Producto creado correctamente.');
    }

    // Método para mostrar el formulario de edición de un producto existente
    public function edit(Producto $producto){
        $categorias = Categoria::all(); // Obtener todas las categorías
        $subcategorias = Subcategoria::all(); // Obtener todas las subcategorías
        $marcas = Marca::all(); // Obtener todas las marcas

        return view('productos.edit', compact('producto', 'categorias', 'subcategorias', 'marcas'));
    }

    // Método para mostrar todos los productos
    public function show(){
        $productos = Producto::paginate(10);
        $categorias = Categoria::all(); // Obtener todas las categorías
        $subcategorias = Subcategoria::all(); // Obtener todas las subcategorías

        return view('productos.show', ['productos' => $productos, 'categorias' => $categorias, 'subcategorias' => $subcategorias]);
    }

    // Método para eliminar un producto existente de la base de datos
    public function destroy($id){
        Producto::findOrFail($id)->delete();

        // Redireccionar a la vista de mostrar productos con un mensaje de éxito
        return redirect()->route('productos.show')->with('success', 'Producto eliminado correctamente.');
    }

    // Método para actualizar los datos de un producto existente en la base de datos
    public function update(Request $request, $id){
        $request->validate([
            'categoria_id' => 'required', // Categoría requerida
            'subcategoria_id' => '', // Subcategoría opcional
            'marca_id' => '', // Validación opcional para la marca_id
            'nombre' => 'required', // Nombre requerido
            'precio_compra' => 'required|numeric|min:0', // Precio de compra requerido, numérico y valor mínimo de 0
            'precio_venta' => 'required|numeric|min:0', // Precio de venta requerido, numérico y valor mínimo de 0
            'unidades_disponibles' => 'required|integer|min:0', // Unidades disponibles requeridas, enteras y valor mínimo de 0
            'creado_por' => 'required', // Creado por requerido
        ]);

        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);
        // Actualizar los datos del producto con los datos proporcionados
        $producto->categoria_id = $request->categoria_id;
        $producto->subcategoria_id = $request->subcategoria_id;
        $producto->marca_id = $request->marca_id; // Asignar la marca_id recibida en el formulario
        $producto->nombre = $request->nombre;
        $producto->precio_compra = $request->precio_compra;
        $producto->precio_venta = $request->precio_venta;
        $producto->unidades_disponibles = $request->unidades_disponibles;
        $producto->creado_por = Auth::user()->name;
        $producto->save();

        // Redireccionar a la vista de mostrar productos con un mensaje de éxito
        return redirect()->route('productos.show')->with('actualizado', 'Producto actualizado correctamente.');
    }
}
