<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //manda a la vista de registro de usuarios
    public function register_view()
    {
        return view('auth.register');
    }
    //funcion para validar el logueo de usuarios
    public function login_user(Request $request)
    {
        //validacion de datos
        $request->validate([
            'email' => 'required|email|max:60',
            'password' => 'required|min:8|max:16',
        ]);

        //autenticacion de usuario
        auth()->attempt($request->only('email', 'password'));

        //redireccionamiento al dashboard ya logueado
        return redirect()->route('dashboard');
    }
    //funcion para registrar usuarios
    public function register_user(Request $request){

        // validacion de datos
        $request->validate([
            'name' => 'required|min:5|max:25',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|min:8|max:16|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);

        //creacion de usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            //encriptacion de contraseña
            'password' => Hash::make($request->password),
        ]);

        //autenticacion de usuario
        auth()->attempt($request->only('email', 'password'));

        //redireccionamiento al dashboard ya logueado
        return redirect()->route('dashboard');
    }

    //manda a la vista de logueo de usuarios
    public function login_view()
    {
        return view('auth.login');
    }

    //funcion para desloguear usuarios
    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    //Manda a la vista del formulario de registro de productos
    public function register_product_view()
    {
        return view('store.register_product');
    }

    //Manda a la vista de elimitar productos y mostrar la tabla de productos
    public function delete_product_view()
    {
        $products = products::all();
        return view('store.delete_product', compact('products'));
    }


    //funcion para agregar productos
    public function add_product(Request $request)
    {
        //validar que se reciban los datos
        // dd($request->all());

        // validacion de datos
        $request->validate([
            'name' => 'required|min:5|max:25',
            'short_description' => 'required|min:5|max:25',
            'long_description' => 'required|min:5|max:120',
            'sale_price' => 'required|min:1|max:25',
            'purchase_price' => 'required|min:1|max:25',
            'stock' => 'required|min:1|max:25',
            'product_id' => 'required|min:1|max:25',
            'fecha' => 'required|min:1|max:25',
            'peso' => 'required|min:1|max:25',
        ]);

        //creacion de producto
        products::create([
            'name' => $request->name,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'sale_price' => $request->sale_price,
            'purchase_price' => $request->purchase_price,
            'stock' => $request->stock,
            'product_id' => $request->product_id,
            'fecha' => $request->fecha,
            'peso' => $request->peso,
        ]);

        //redireccionamiento al dashboard ya logueado
        return redirect()->route('products');
    }

    //funcion para eliminar productos
    public function delete_product_table($id)
    {
        // Eliminación del producto
        products::where('id', $id)->delete();

        // Redireccionamiento al dashboard ya logueado
        return redirect()->route('products');
    }
}
