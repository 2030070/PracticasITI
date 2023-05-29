<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostCOntroller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

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

// Ruta para vista de alumnos
Route::view('/alumnos','alumnos');

// Ruta para vista del curriculum
Route::view('/curriculum','curriculum');

// // Ruta para vista registro de usuarios
// Route::get('/crear-cuenta', [RegisterController::class,'index']);

// se pueden crear alias
// Ruta para vista registro de usuarios
Route::get('/crear', [RegisterController::class,'index'])->name('register');

// // Ruta para enviar datos al servidor
// Route::post('/crear-cuenta', [RegisterController::class,'store']);

// Ruta para enviar datos al servidor
Route::post('/crear', [RegisterController::class,'store']);

//Ruta para mostrar el dashboard del usuario identificado

Route::get('/muro',[PostCOntroller::class,'index'])->name('post_index');

//Ruta para Login
Route::get('/login',[LoginController::class,'index'])->name('login');

//Ruta de validacion del login
Route::post('/login',[LoginController::class,'store']);

//Ruta de validacion del logout
Route::post('/logout',[LogoutController::class,'store'])->name('logout');
// Route::get('/logout',[LogoutController::class,'store'])->name('logout');
