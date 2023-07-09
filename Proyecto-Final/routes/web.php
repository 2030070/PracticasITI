<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\SubcategoriaController;

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
// Route::get('/login',[LoginController::class,'index'])->name('login');
// //Ruta de validacion del login
// Route::post('/login',[LoginController::class,'store']);
// Ruta de inicio de sesión
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

// Otras rutas de tu aplicación...

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
// Redireccionar para editar la categoría
Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('marcas.edit');
// Actualizar la categoría
Route::put('/marcas/{id}/edit', [MarcaController::class, 'update'])->name('marcas.update');


Route::get('/subcategorias/create', [SubcategoriaController::class, 'create'])->name('subcategorias.create');
// Crea el registro de la categoría
Route::post('/subcategorias', [SubcategoriaController::class, 'store'])->name('subcategorias.store');
// Redirecciona para ver el contenido en la vista de show de la categoría
Route::get('/subcategorias', [SubcategoriaController::class, 'show'])->name('subcategorias.show');
// Redirecciona al dashboard después de haber eliminado la categoría
Route::delete('/subcategorias/{id}', [SubcategoriaController::class, 'destroy'])->name('subcategorias.destroy');
// Redireccionar para editar la categoría
Route::get('/subcategorias/{subcategoria}/edit', [SubcategoriaController::class, 'edit'])->name('subcategorias.edit');
// Actualizar la categoría
Route::put('/subcategorias/{id}/edit', [SubcategoriaController::class, 'update'])->name('subcategorias.update');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');


// Redirecciona a las devolucciones ventas
Route::get('/devoluciones/create', [DevolucionController::class, 'create'])->name('devoluciones.create');
// Redirecciona a crear el registro devolucciones ventas
Route::post('/devoluciones/devolucion-store', [DevolucionController::class, 'store'])->name('devoluciones.store');
// Redirecciona a para mostrar las devolucciones ventas
Route::get('/devoluciones', [DevolucionController::class, 'show'])->name('devoluciones.show');
// Redirecciona a para mostrar las devolucciones ventas
Route::delete('/devoluciones/{id}', [DevolucionController::class, 'destroy'])->name('devoluciones.destroy');