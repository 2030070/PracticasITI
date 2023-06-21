<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use auth;

class RegisterController extends Controller
{
    //crear nuestro primer metodo del controlador
    public function index() {
        return view('auth.register');
    }

    public function store(Request $request) {
        //"dd" dump or die imprime lo que se tiene en el proyecto y lo depura
        //dd ('Post...');
        //dd($request->get('username'));


        //modifico el request para que no se repitan los username
        $request->request->add(['username'=>Str::slug($request->username)]);
        //validaciones del formulario de registros
        $this->validate($request,[
            'name'=>'required|min:5', 
            'username'=>'required|unique:users|min:3|max:20', 
            'email'=>'required|unique:users|email|max:60', 
            'password'=>'required|confirmed|min:6', 
            'password_confirmation'=>''
        ]);

        //Invocar el modelo User para crear el registro
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            //Insertar username en minuscula y mayusculas
            'username'=>$request->username,
            'password'=>$request->password,
            'password'=>Hash::make($request->password)

            
        ]);

        //autenticar un usuario con el moetodo attemp
        auth()->attempt($request->only('email','password'));

        //redireccionamiento
        return redirect()->route('post_index',auth()->user()->username);

        
    }
}
