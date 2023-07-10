<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller{
    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'imagen' => 'required',
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'creado_por' => 'required',
        ]);


        Marca::create([
            'imagen' => $request->imagen,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'creado_por' => Auth::user()->name,
        ]);

        $nombreUsuario = Auth::user()->name;
        return redirect()->route('marcas.show', ['nombreUsuario' => $nombreUsuario])->with('success', 'Marca creada exitosamente.');
    }

    public function show(){
        $marcas = Marca::paginate(10);
        return view('marcas.show', ['marcas' => $marcas]);
    }

    public function destroy(Marca $marca){
        // Eliminar la imagen asociada a la marca
        Storage::disk('public')->delete('uploads/' . $marca->imagen);

        $marca->delete();

        return redirect()->route('marcas.show');
    }

    public function edit(Marca $marca){
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'creado_por' => 'required',
        ]);

        $marca->nombre = $request->nombre;
        $marca->descripcion = $request->descripcion;
        $marca->creado_por = Auth::user()->name;
        $marca->save();

        return redirect()->route('marcas.show')->with('success', 'Marca actualizada exitosamente.');
    }

    public function updateImagen(Request $request, Marca $marca)
    {
        $request->validate([
            'imagen' => 'required',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior
            Storage::disk('public')->delete('uploads/' . $marca->imagen);

            // Procesar y almacenar la nueva imagen
            $imagenPath = $request->file('imagen')->store('uploads', 'public');
            $imagen = Image::make(public_path("storage/{$imagenPath}"))->fit(500, 500);
            $imagen->save();

            $marca->imagen = $imagenPath;
            $marca->save();

            return redirect()->route('marcas.show')->with('success', 'Imagen de la marca actualizada exitosamente.');
        }

        return redirect()->route('marcas.show')->with('error', 'Error al actualizar la imagen de la marca.');
    }
}
