<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function create()
    {
        $categorias = Categoria::all();
        // $subcategorias = Subcategoria::all();
        return view('productos.create', compact('categorias'));
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
         // Redirigir a la vista de mostrar categorías
         $nombreUsuario = Auth::user()->name;
        return redirect()->route('productos.show', ['nombreUsuario' => $nombreUsuario]);
    }

    //Manda los datos de la tabla productos a la vista show productos y pagina el contenido de 10 en 10
    public function show($nombreUsuario){
        $productos = Producto::paginate(10);
        return view('productos.show',  ['productos' => $productos, 'nombreUsuario' => $nombreUsuario]);
    }

    //Elimina el contenido de la base de datos con ayuda del id del producto creado
    public function destroy($id){
        Producto::findOrFail($id)->delete();
        return redirect()->route('post_index');
    }
}
