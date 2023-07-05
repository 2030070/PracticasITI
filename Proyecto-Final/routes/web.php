<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
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
//Ruta para Login
Route::get('/login',[LoginController::class,'index'])->name('login');
//Ruta de validacion del login
Route::post('/login',[LoginController::class,'store']);
//Ruta de validacion del logout
Route::post('/logout',[LogoutController::class,'store'])->name('logout');
// Route::get('/logout',[LogoutController::class,'store'])->name('logout');
Route::get('/dashboard',[DashboardController::class,'index'])->name('post_index');

//Redireccionar para hacer el registro de la cateoria
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
//Crea el registro de la categoria
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
//Redirecciona para ver el contenido en la vista de show de la categoria
Route::get('/categorias/list', [CategoriaController::class, 'show'])->name('categorias.show');
//Redirecciona al dashboar despues de haber eliminado la categoria
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

//Redireccionar para hacer el registro de la cateoria
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
//Crea el registro de la categoria
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
//Redirecciona para ver el contenido en la vista de show de la categoria
Route::get('/productos/list', [ProductoController::class, 'show'])->name('productos.show');
//Redirecciona al dashboar despues de haber eliminado la categoria
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');