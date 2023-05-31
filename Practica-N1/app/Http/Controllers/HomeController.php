<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //vista para la pagina principal
    public function index()
    {
        return view('layouts.app');
    }

    //vista para el dashboard
    public function dashboard()
    {
        return view('auth.dashboard');
    }
}
