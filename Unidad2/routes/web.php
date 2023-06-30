<?php

use App\Http\Controllers\ComentarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Models\Comentario;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ruta para vista página principal
Route::get('/',[DashboardController::class,'inicio']);
//Ruta para Login
Route::get('/login',[LoginController::class,'index'])->name('login');
//Ruta de validacion del login
Route::post('/login',[LoginController::class,'store']);
//Ruta de validacion del logout
Route::post('/logout',[LogoutController::class,'store'])->name('logout');
// Route::get('/logout',[LogoutController::class,'store'])->name('logout');
Route::get('/dashboard',[PostController::class,'index'])->name('post_index');

//Ruta para mostrar el dashboard del usuario identificado

