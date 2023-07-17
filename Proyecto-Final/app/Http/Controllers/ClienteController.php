<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function __construct(){
        //protegemos la url
        //al metodo index con el constructor le pasamos el parametro de autenticacion
        $this->middleware('auth');
    }
    //
    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'imagen' => 'required',
            'codigo' => 'required|unique:clientes,codigo',
            'empresa' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
        ]);


        Cliente::create([
            'nombre' => $request->nombre,
            'imagen' => $request->imagen,
            'codigo' => $request->codigo,
            'empresa' => $request->empresa,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
        ]);

        return redirect()->route('clientes.show')->with('success', 'Cliente creado exitosamente.');
    }

    public function show()
    {
        $clientes = Cliente::paginate(10);
        return view('clientes.show', ['clientes' => $clientes]);
    }

    public function destroy(Cliente $cliente)
    {
        Storage::disk('public')->delete('uploads/' . $cliente->imagen);
        $cliente->delete();

        return redirect()->route('clientes.show')->with('success', 'Cliente eliminado correctamente.');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'codigo' => 'required',
            'empresa' => 'required',
            'telefono' => 'required',
            'correo' => 'required|email',
        ]);

        $cliente->nombre = $request->nombre;
        $cliente->codigo = $request->codigo;
        $cliente->empresa = $request->empresa;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->save();

        return redirect()->route('clientes.show')->with('success', 'Cliente actualizado exitosamente.');
    }

    public function updateImagen(Request $request, Cliente $cliente)
    {
        $request->validate([
            'imagen' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior
            Storage::disk('public')->delete('uploads/' . $cliente->imagen);

            // Procesar y almacenar la nueva imagen
            $imagenPath = $request->file('imagen')->store('uploads', 'public');
            $imagen = Image::make(public_path("storage/{$imagenPath}"))->fit(500, 500);
            $imagen->save();

            $cliente->imagen = $imagenPath;
            $cliente->save();

            return redirect()->route('clientes.show')->with('success', 'Imagen de la cliente actualizada exitosamente.');
        }

        return redirect()->route('clientes.show')->with('error', 'Error al actualizar la imagen de la cliente.');
    }
}
