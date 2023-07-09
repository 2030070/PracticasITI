<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ImagenController;
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
// Redireccionar para hacer el registro de la categoría
Route::get('/categorias/create', [CategoriaController::class, 'create'])->name('categorias.create');
// Crea el registro de la categoría
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
// Redirecciona para ver el contenido en la vista de show de la categoría
Route::get('/categorias', [CategoriaController::class, 'show'])->name('categorias.show');
// Redirecciona al dashboard después de haber eliminado la categoría
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
// Redireccionar para editar la categoría
Route::get('/categorias/{categoria}/edit', [CategoriaController::class, 'edit'])->name('categorias.edit');
// Actualizar la categoría
Route::put('/categorias/{id}/edit', [CategoriaController::class, 'update'])->name('categorias.update');
//Redireccionar para hacer el registro de la cateoria
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
//Crea el registro de la categoria
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
//Redirecciona para ver el contenido en la vista de show de la categoria
Route::get('/productos', [ProductoController::class, 'show'])->name('productos.show');
//Redirecciona al dashboar despues de haber eliminado la categoria
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
// Redireccionar para editar la categoría
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
// Actualizar la categoría
Route::put('/productos/{id}/edit', [ProductoController::class, 'update'])->name('productos.update');


// Ruta para mostrar el formulario de creación de una marca
Route::get('/marcas/create', [MarcaController::class, 'create'])->name('marcas.create');
// Ruta para almacenar una nueva marca
Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store');
// Ruta para mostrar las marcas existentes
Route::get('/marcas', [MarcaController::class, 'show'])->name('marcas.show');
// Ruta para eliminar una marca
Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy'])->name('marcas.destroy');

// Ruta para mostrar el formulario de creación de una marca
Route::get('/subcategorias/create', [MarcaController::class, 'create'])->name('subcategorias.create');
// Ruta para almacenar una nueva marca
Route::post('/subcategorias', [MarcaController::class, 'store'])->name('subcategorias.store');
// Ruta para mostrar las marcas existentes
Route::get('/subcategorias', [MarcaController::class, 'show'])->name('subcategorias.show');
// Ruta para eliminar una marca
Route::delete('/subcategorias/{subcategoria}', [MarcaController::class, 'destroy'])->name('subcategorias.destroy');


Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');
