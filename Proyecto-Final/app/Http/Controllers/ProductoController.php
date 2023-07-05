<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function create()
    {
        $categorias = Categoria::all();
        // $subcategorias = Subcategoria::all();
        return view('productos.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'categoria_id' => 'required',
            'subcategoria_id' => '',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'unidades_disponibles' => 'required|integer|min:0',
            'creado_por' => 'required',
        ]);

        Producto::create([
            'categoria_id' => $request->categoria_id,
            'subcategoria_id' => $request->subcategoria_id,
            'precio_compra' => $request->precio_compra,
            'precio_venta' => $request->precio_venta,
            'unidades_disponibles' => $request->unidades_disponibles,
            'creado_por' => $request->creado_por,
        ]);

        return redirect()->route('productos.show');
    }

    public function show()
    {
        $productos = Producto::paginate(10);
        return view('productos.show', compact('productos'));
    }

    public function destroy($id)
    {
        Producto::findOrFail($id)->delete();
        return redirect()->route('post_index');
    }
}
