<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index() {
        return view('auth.login');
    }
    //validar formulario de login
    public function store(Request $request) {
        //reglas de validacion
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        //verificar que las credenciales sean correctas
        if(!auth()->attempt($request->only('email','password'),$request->remember)){
            //usar la directica with para llenar los valores de la sesión
            return back()->with('mensaje','Credenciales incorrectas');
        }

        //credenciales correctas
        return redirect()->route('post_index',auth()->user()->username);
    }
}
