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
// Route::get('/muro',[PostController::class,'index'])->name('post_index');

//Ruta para Login
Route::get('/login',[LoginController::class,'index'])->name('login');

//Ruta de validacion del login
Route::post('/login',[LoginController::class,'store']);

//Ruta de validacion del logout
Route::post('/logout',[LogoutController::class,'store'])->name('logout');
// Route::get('/logout',[LogoutController::class,'store'])->name('logout');


Route::get('/{user:username}',[PostController::class,'index'])->name('post_index');
// Ruta para el formulario de publicaciónes
Route::get('post/crear',[PostController::class,'create'])->name('post.create');

Route::post('post/crear',[PostController::class,'store'])->name('post.store');

Route::get('/{user:username}/post/{post}',[PostController::class,'show'])->name('posts.show');

Route::delete('post/{post}',[PostController::class,'destroy'])->name('posts.destroy');

Route::post('/{user:username}/post/{post}',[ComentarioController::class,'store'])->name('comentarios.store');

Route::delete('/comentarios/{comentario}', [ComentarioController::class,'destroy'])->name('comentario.destroy');


Route::post('/imagenes',[ImagenController::class,'store'])->name('imagenes.store');

//Ruta para mostrar el dashboard del usuario identificado

