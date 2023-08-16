<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller{
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
            'imagen' => '', // Imagen requerida
            'categoria_id' => 'required', // Categoría requerida
            'subcategoria_id' => '', // Subcategoría opcional
            'marca_id' => '', // Validación opcional para la marca_id
            'nombre' => 'required|min:3', // Nombre requerido y longitud mínima de 3 caracteres
            'precio_compra' => 'required|numeric|min:1', // Precio de compra requerido, numérico y valor mínimo de 0
            'precio_venta' => 'required|numeric|min:1', // Precio de venta requerido, numérico y valor mínimo de 0
            'unidades_disponibles' => 'required|integer|min:1', // Unidades disponibles requeridas, enteras y valor mínimo de 0
            'creado_por' => 'required', // Creado por requerido
        ]);

        // Crear un nuevo producto en la base de datos con los datos proporcionados
        Producto::create([
            'imagen' => $request->imagen,
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
        $productos = Producto::all();
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
            'imagen' => '',
            'categoria_id' => 'required', // Categoría requerida
            'subcategoria_id' => '', // Subcategoría opcional
            'marca_id' => '', // Validación opcional para la marca_id
            'nombre' => 'required', // Nombre requerido
            'precio_compra' => 'required|numeric|min:1', // Precio de compra requerido, numérico y valor mínimo de 0
            'precio_venta' => 'required|numeric|min:1', // Precio de venta requerido, numérico y valor mínimo de 0
            'unidades_disponibles' => 'required|integer|min:1', // Unidades disponibles requeridas, enteras y valor mínimo de 0
            'creado_por' => 'required', // Creado por requerido
        ]);

        // Buscar el producto por su ID
        $producto = Producto::findOrFail($id);
        // Actualizar los datos del producto con los datos proporcionados
        $producto->imagen = $request->imagen;
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
        return redirect()->route('productos.show')->with('actualizada', 'Producto actualizado correctamente.');
    }

    // Método para actualizar la imagen de una marca existente
    public function updateImagen(Request $request, Producto $producto){
        $request->validate([
            'imagen' => 'required|image|max:2048', // Imagen requerida y tamaño máximo de 2MB
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior
            Storage::disk('public')->delete('uploads/' . $producto->imagen);

            // Procesar y almacenar la nueva imagen
            $imagenPath = $request->file('imagen')->store('uploads', 'public');
            $imagen = Image::make(public_path("storage/{$imagenPath}"))->fit(500, 500);
            $imagen->save();

            $producto->imagen = $imagenPath;
            $producto->save();

            // Redireccionar a la vista de mostrar productos con un mensaje de éxito
            return redirect()->route('productos.show')->with('success', 'Imagen de prodctos actualizada exitosamente.');
        }

        // Redireccionar a la vista de mostrar marcas con un mensaje de error
        return redirect()->route('productos.show')->with('error', 'Error al actualizar la imagen de productos.');
    }

    //mostrar los detalles de los productos
    public function showDetails($id) {
        $producto = Producto::findOrFail($id);
        return view('productos.detalle', compact('producto'));
    }
    
    //metodo para importar productos desde un archivo CSV con las columnas establecidas para guardar los valores en las tablas 
    //de los modelos de la base de datos en la base de datos
    public function importarProductos(Request $request){
        $archivoCsv = $request->file('archivo_csv');

        // Validar si se seleccionó un archivo
        if ($archivoCsv == null) {
            return redirect()->route('productos.show')->with('error', 'Debe seleccionar un archivo CSV.');
        }

        // Leer el contenido del archivo CSV
        $contenido = file_get_contents($archivoCsv);
        $lineas = explode(PHP_EOL, $contenido);

        // Recorrer las líneas del CSV, comenzando desde la segunda línea (índice 1)
        for ($i = 1; $i < count($lineas); $i++) {
            $datos = str_getcsv($lineas[$i]);

            // Verificar que $datos tenga la cantidad de elementos esperada (al menos 7 elementos)
            if (count($datos) < 7) {
                continue; // Saltar esta línea si no tiene suficientes elementos
            }

            // Validar los campos requeridos en el CSV
            $validator = Validator::make([
                'nombre' => $datos[0],
                'categoria_id' => $datos[1],
                'precio_compra' => $datos[2],
                'precio_venta' => $datos[3],
                'unidades_disponibles' => $datos[4],
                'marca_id' => $datos[5], // Agregamos el campo marca al Validator
                'subcategoria_id' => $datos[6],
            ], [
                'nombre' => 'required|string',
                'categoria_id' => 'required|string',
                'precio_compra' => 'required|numeric',
                'precio_venta' => 'required|numeric',
                'unidades_disponibles' => 'required|integer',
                'marca_id' => 'nullable|string', // La marca es obligatoria
                'subcategoria_id' => 'nullable|string', // La subcategoría puede ser nula
            ]);

            if ($validator->fails()) {
                continue; // Saltar esta línea si no cumple con las validaciones
            }

            // Obtener o crear la marca por nombre
            $marca = Marca::where('nombre', $datos[5])->first();

            // Si no se encontró la marca, omitir la creación del producto para esta línea
            if (!$marca) {
                continue;
            }

            // Crear un nuevo registro de Producto con los datos del CSV
            $producto = new Producto();
            $producto->nombre = $datos[0];
            $producto->precio_compra = $datos[2];
            $producto->precio_venta = $datos[3];
            $producto->unidades_disponibles = $datos[4];
            // Obtener la categoría por código
            $categoria = Categoria::where('codigo', $datos[1])->first();
            // Si no se encontró la categoría, saltamos esta línea
            if (!$categoria) {
                continue;
            }

            // Asignar el usuario actual como creador del producto
            $producto->creado_por = Auth::user()->name;
            // Si se proporcionó el código de subcategoría en el CSV
            if ($datos[6]) {
                // Obtener la subcategoría por código y que pertenezca a la categoría encontrada
                $subcategoria = Subcategoria::where('codigo', $datos[6])
                    ->where('categoria_id', $categoria->id)
                    ->first();

                // Si no se encontró la subcategoría, saltamos esta línea
                if (!$subcategoria) {
                    continue;
                }

                // Asociar la subcategoría al producto
                $producto->subcategoria_id = $subcategoria->id;
            }
            // Asociar la categoría al producto
            $producto->categoria_id = $categoria->id;
            // Asociar la marca al producto
            $producto->marca_id = $marca->id;
            $producto->save();
        }

        return redirect()->route('productos.show')->with('success', 'Productos importados exitosamente.');
    }

}
