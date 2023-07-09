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

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'nombre' => 'required|max:255',
    //         'descripcion' => 'required',
    //         'creado_por' => 'required'
    //     ]);

    //     // // Obtener la imagen del request
    //     // $imagen = $request->file('imagen');
    //     // // Generar un nombre único para la imagen
    //     // $nombreImagen = Str::uuid() . "." . $imagen->extension();
    //     // // Guardar la imagen en la carpeta "uploads"
    //     // $imagen->storeAs('uploads', $nombreImagen, 'public');

    //     // Crear la marca con los datos proporcionados
    //     Marca::create([
    //         'imagen' => $request->imagen,
    //         'nombre' => $request->nombre,
    //         'descripcion' => $request->descripcion,
    //         'creado_por' => Auth::user()->name,
    //     ]);

    //     $nombreUsuario = Auth::user()->name;
    //     return redirect()->route('marcas.index', ['nombreUsuario' => $nombreUsuario])->with('success', 'Marca creada exitosamente.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'imagen' => 'required',
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'creado_por' => 'required'
        ]);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('uploads') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        Marca::create([
            'imagen' => $nombreImagen,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'creado_por' => Auth::user()->name,
        ]);

        $nombreUsuario = Auth::user()->name;
        return redirect()->route('marcas.show', ['nombreUsuario' => $nombreUsuario])->with('success', 'Marca creada exitosamente.');
    }

    public function show()
    {
        $marcas = Marca::paginate(10);
        return view('marcas.show', ['marcas' => $marcas]);
    }

    public function destroy(Marca $marca)
    {
        // Eliminar la imagen asociada a la marca
        Storage::disk('public')->delete('uploads/' . $marca->imagen);

        $marca->delete();

        return redirect()->route('post_index');
    }
}
