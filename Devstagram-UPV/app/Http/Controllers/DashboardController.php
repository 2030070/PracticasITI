<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function inicio() {
        return view('auth.principal');
    }
}
