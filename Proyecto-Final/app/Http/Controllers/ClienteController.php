<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\Cliente;
use App\Models\Country;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function __construct(){
        // Protegemos la URL utilizando el middleware 'auth'.
        // Esto asegura que solo usuarios autenticados puedan acceder a las rutas de este controlador.
        $this->middleware('auth');
    }
    
    //Metodo para mostrar el formulario de registrar al cliente
    public function create(){ 
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();

        return view('clientes.create', ['countries' => $countries,'states' => $states, 'cities' => $cities]);
    }

    // Almacenar un nuevo cliente en la base de datos
    public function store(Request $request){
        // Validamos los datos enviados desde el formulario de creación del cliente.
        // Establecemos reglas de validación para cada campo.
        $request->validate([
            'nombre' => 'required|max:255',
            'imagen' => 'required',
            'codigo' => 'required|unique:clientes,codigo',
            'empresa' => 'required|min:3',
            'telefono' => 'required|min:7|max:12',
            'correo' => 'required|email',
            'pais' => 'required',
            'estado' => 'required',
            'ciudad' => 'required'
        ]);

        // Creamos un nuevo registro de cliente en la base de datos utilizando el modelo Cliente.
        // Los datos del cliente se toman del objeto $request que contiene los datos enviados desde el formulario.
        Cliente::create([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'codigo' => $request->codigo,
            'empresa' => $request->empresa,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'pais' => $request->pais,
            'estado' => $request->estado,
            'ciudad' => $request->ciudad,
        ]);

        // Redirigimos al usuario a la ruta 'clientes.show' (que muestra la lista de clientes) con un mensaje de éxito.
        return redirect()->route('clientes.show')->with('success', 'Cliente creado exitosamente.');
    }

    // Mostrar la lista de clientes
    public function show(){
        // Obtenemos todos los registros de clientes desde la base de datos utilizando el modelo Cliente.
        // Luego, los enviamos a la vista 'clientes.show' para que puedan ser mostrados.
        $clientes = Cliente::all();
        return view('clientes.show', ['clientes' => $clientes]);
    }

    // Eliminar un cliente de la base de datos
    public function destroy(Cliente $cliente){
        // Utilizamos el objeto $cliente pasado como parámetro para acceder a los datos del cliente que se desea eliminar.

        // Primero, eliminamos la imagen asociada al cliente almacenada en el sistema de archivos utilizando el Storage de Laravel.
        Storage::disk('public')->delete('uploads/' . $cliente->imagen);

        // Luego, eliminamos el registro del cliente de la base de datos.
        $cliente->delete();

        // Redirigimos al usuario a la ruta 'clientes.show' (que muestra la lista de clientes) con un mensaje de éxito.
        return redirect()->route('clientes.show')->with('success', 'Cliente eliminado correctamente.');
    }

    // Mostrar el formulario de edición de cliente
    public function edit(Cliente $cliente){
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();

        // Utilizamos el objeto $cliente pasado como parámetro para acceder a los datos del cliente que se desea editar.
        // Luego, enviamos estos datos a la vista 'clientes.edit' para que puedan ser mostrados en el formulario de edición.
        return view('clientes.edit', compact('cliente','countries','states'));
    }

    // Actualizar un cliente en la base de datos
    public function update(Request $request, Cliente $cliente){
        // Validamos los datos enviados desde el formulario de edición del cliente.
        // Establecemos reglas de validación para cada campo.
        $request->validate([
            'nombre' => 'required|max:255',
            'codigo' => 'required',
            'empresa' => 'required|min:3',
            'telefono' => 'required|min:7|max:12',
            'correo' => 'required|email',
            'imagen' => 'required',
            'pais' => 'required',
            'estado' => 'required',
            'ciudad' => 'required',
        ]);

        // Actualizamos los datos del cliente en la base de datos utilizando el objeto $cliente pasado como parámetro.
        // Los nuevos datos se toman del objeto $request que contiene los datos enviados desde el formulario de edición.
        $cliente->nombre = $request->nombre;
        $cliente->codigo = $request->codigo;
        $cliente->empresa = $request->empresa;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->imagen = $request->imagen;
        $cliente->pais = $request->pais;
        $cliente->estado = $request->estado;
        $cliente->ciudad = $request->ciudad;	
        $cliente->save();

        // Redirigimos al usuario a la ruta 'clientes.show' (que muestra la lista de clientes) con un mensaje de éxito.
        return redirect()->route('clientes.show')->with('success', 'Cliente actualizado exitosamente.');
    }

    // Actualizar la imagen de un cliente en la base de datos
    public function updateImagen(Request $request, Cliente $cliente){
        // Validamos los datos enviados desde el formulario de actualización de imagen del cliente.
        // Establecemos reglas de validación para el campo 'imagen'.
        $request->validate([
            'imagen' => 'required|image|max:2048',
        ]);

        // Verificamos si se ha enviado un nuevo archivo de imagen.
        if ($request->hasFile('imagen')) {
            // Eliminamos la imagen anterior asociada al cliente utilizando el Storage de Laravel.
            Storage::disk('public')->delete('uploads/' . $cliente->imagen);

            // Procesamos y almacenamos la nueva imagen en el sistema de archivos utilizando el Storage de Laravel.
            $imagenPath = $request->file('imagen')->store('uploads', 'public');

            // También redimensionamos la nueva imagen para que tenga un tamaño máximo de 500x500 píxeles utilizando la biblioteca Intervention Image.
            $imagen = Image::make(public_path("storage/{$imagenPath}"))->fit(500, 500);
            $imagen->save();

            // Actualizamos la ruta de la imagen del cliente en la base de datos con la nueva ruta de la imagen.
            $cliente->imagen = $imagenPath;
            $cliente->save();

            // Redirigimos al usuario a la ruta 'clientes.show' (que muestra la lista de clientes) con un mensaje de éxito.
            return redirect()->route('clientes.show')->with('success', 'Imagen del cliente actualizada exitosamente.');
        }

        // Si no se envió una nueva imagen, redirigimos al usuario a la ruta 'clientes.show' con un mensaje de error.
        return redirect()->route('clientes.show')->with('error', 'Error al actualizar la imagen del cliente.');
    }
}
