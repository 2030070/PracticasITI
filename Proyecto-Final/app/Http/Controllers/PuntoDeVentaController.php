<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class PuntoDeVentaController extends Controller
{
    //
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        $productos = Producto::query();

        // Filtrar por categoría si se selecciona una en el formulario
        if ($request->has('categoria_id')) {
            $categoriaId = $request->input('categoria_id');
            $productos->where('categoria_id', $categoriaId);
        }

        $productos = $productos->get();

        return view('index', compact('categorias', 'productos')); // Corrige la ruta de la vista
    }
}
