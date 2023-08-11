<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth'); // Middleware para autenticación
    }

    public function create(){ 
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();

        return view('usuarios.create', ['countries' => $countries,'states' => $states, 'cities' => $cities]);
    }

    // Método para almacenar un nuevo proveedor en la base de datos
    public function store(Request $request){
        
        $request->validate([
            'nombre' => 'required', // Campo nombre requerido
            'apellidos' => 'required', //
            'usuario' => 'required', //
            'password' => 'required', //
            'telefono' => 'required|max:10', // Campo teléfono requerido
            'email' => 'required|email', // Campo email requerido y debe ser una dirección de correo válida y única en la tabla proveedores
            'rol' => 'required',
            'creado_por' => 'required',
            'pais' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'imagen' => 'required',
        ]);

        // Crear un nuevo proveedor en la base de datos con los datos proporcionados
        Usuario::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'usuario' => $request->usuario,
            'password' => $request->password,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'rol' => $request->rol,
            'creado_por' => Auth::user()->name,
            'pais' => $request->pais,
            'estado' => $request->estado,
            'ciudad' => $request->ciudad,
            'imagen' => $request->imagen,

        ]);
        
        // Obtener el nombre del usuario autenticado
        $nombreUsuario = Auth::user()->name;

        // Redireccionar a la vista de mostrar proveedores con un mensaje de éxito
        return redirect()->route('usuarios.show',['nombreUsuario' => $nombreUsuario])->with('success', 'Proveedor creado exitosamente.');
    }

    // Método para mostrar todos los proveedores
    public function show(){
        // Obtener una lista paginada de proveedores (10 proveedores por página)
        $usuarios = Usuario::all();
        return view('usuarios.show', ['usuarios' => $usuarios]);
    }

    // Método para mostrar el formulario de edición de un proveedor existente
    public function edit(Usuario $usuario){
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        return view('usuarios.edit', compact('usuario','countries','states'));
    }

    // Método para actualizar los datos de un proveedor existente en la base de datos
    public function update(Request $request, Usuario $usuario){
        $request->validate([
            'nombre' => 'required', // Campo nombre requerido
            'apellidos' => 'required', //
            'usuario' => 'required', //
            'password' => 'required', //
            'telefono' => 'required|max:10', // Campo teléfono requerido
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'rol' => 'required',
            'creado_por' => 'required',
            'pais' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
            'imagen' => 'required',
        ]);

        // Actualizar los datos del proveedor con los datos proporcionados
        $usuario->nombre = $request->nombre;
        $usuario->apellidos = $request->apellidos;
        $usuario->usuario = $request->usuario;
        $usuario->password = $request->password;
        $usuario->telefono = $request->telefono;
        $usuario->email = $request->email;
        $usuario->rol = $request->rol;
        $usuario->creado_por = Auth::user()->name;
        $usuario->pais = $request->pais;
        $usuario->estado = $request->estado;
        $usuario->ciudad = $request->ciudad;
        $usuario->imagen = $request->imagen;
        $usuario->save();

        // Redireccionar a la vista de mostrar proveedores con un mensaje de éxito
        return redirect()->route('usuarios.show', ['usuario' => $usuario->id])->with('success', 'Usuario actualizado exitosamente.');
    }

    // Método para eliminar un proveedor existente de la base de datos
    public function destroy(Usuario $usuario){
        $usuario->delete();

        // Redireccionar a la vista de mostrar proveedores con un mensaje de éxito
        return redirect()->route('usuarios.show')->with('success', 'Usuario eliminado correctamente.');
    }
}
