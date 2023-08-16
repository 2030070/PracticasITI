<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/* Controlador para el inicio de sesion donde se utilizan las funciones 'Store' para validar y redireccionar al index
   asi como el metodo 'index' donde solo retorna a la vista
*/
class LoginController extends Controller{
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
        return redirect()->route('post_index');
    }
}
