<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        //Mostrar la vita del login de usuarios
        return view('auth.login');
    }

    //Validar formulario de login
    public function store(Request $request){
        $this->validate($request,[
            //Reglas de validacion 
            'email' => 'required|email',
            'password' =>'required|min:6'

        ]);

        //Validar si el usuario existe
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            //usar la directiva with para llenar los valores de la sesion

            return back()->with('mensaje','credenciales incorrectas');
        }
        return redirect()->route('post_index');
        // else{
        //     return redirect()->route('login');
        // }
    }

}
