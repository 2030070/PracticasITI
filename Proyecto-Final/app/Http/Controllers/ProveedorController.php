<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth'); // Middleware para autenticación
    }

    // Método para mostrar el formulario de creación de proveedor
    public function create(){
        return view('proveedores.create');
    }

    // Método para almacenar un nuevo proveedor en la base de datos
    public function store(Request $request){
        $request->validate([
            'nombre' => 'required', // Campo nombre requerido
            'codigo' => 'required|unique:proveedores,codigo', // Campo código requerido y único en la tabla proveedores
            'telefono' => 'required', // Campo teléfono requerido
            'email' => 'required|email|unique:proveedores', // Campo email requerido y debe ser una dirección de correo válida y única en la tabla proveedores
        ]);

        // Crear un nuevo proveedor en la base de datos con los datos proporcionados
        Proveedor::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'telefono' => $request->telefono,
            'email' => $request->email,
        ]);

        // Redireccionar a la vista de mostrar proveedores con un mensaje de éxito
        return redirect()->route('proveedores.show')->with('success', 'Proveedor creado exitosamente.');
    }

    // Método para mostrar todos los proveedores
    public function show(){
        // Obtener una lista paginada de proveedores (10 proveedores por página)
        $proveedores = Proveedor::paginate(10);
        return view('proveedores.show', ['proveedores' => $proveedores]);
    }

    // Método para mostrar el formulario de edición de un proveedor existente
    public function edit(Proveedor $proveedor){
        return view('proveedores.edit', compact('proveedor'));
    }

    // Método para actualizar los datos de un proveedor existente en la base de datos
    public function update(Request $request, Proveedor $proveedor){
        $request->validate([
            'nombre' => 'required', // Campo nombre requerido
            'codigo' => 'required', // Campo código requerido
            'telefono' => 'required', // Campo teléfono requerido
            'email' => 'required|email', // Campo email requerido y debe ser una dirección de correo válida
        ]);

        // Actualizar los datos del proveedor con los datos proporcionados
        $proveedor->nombre = $request->nombre;
        $proveedor->codigo = $request->codigo;
        $proveedor->telefono = $request->telefono;
        $proveedor->email = $request->email;
        $proveedor->save();

        // Redireccionar a la vista de mostrar proveedores con un mensaje de éxito
        return redirect()->route('proveedores.show')->with('success', 'Proveedor actualizado exitosamente.');
    }

    // Método para eliminar un proveedor existente de la base de datos
    public function destroy(Proveedor $proveedor){
        $proveedor->delete();

        // Redireccionar a la vista de mostrar proveedores con un mensaje de éxito
        return redirect()->route('proveedores.show')->with('success', 'Proveedor eliminado correctamente.');
    }
}
