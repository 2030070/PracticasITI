<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProveedorController;
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

//Redireccionar para hacer el registro de los productos
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
//Crea el registro de la productos
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
//Redirecciona para ver el contenido en la vista de show de la productos
Route::get('/productos', [ProductoController::class, 'show'])->name('productos.show');
//Redirecciona al dashboar despues de haber eliminado la productos
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');
// Redireccionar para editar la productos
Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
// Actualizar la productos
Route::put('/productos/{id}/edit', [ProductoController::class, 'update'])->name('productos.update');


// Ruta para mostrar el formulario de creación de una marca
Route::get('/marcas/create', [MarcaController::class, 'create'])->name('marcas.create');
// Ruta para almacenar una nueva marca
Route::post('/marcas', [MarcaController::class, 'store'])->name('marcas.store');
// Ruta para mostrar las marcas existentes
Route::get('/marcas', [MarcaController::class, 'show'])->name('marcas.show');
// Ruta para eliminar una marca
Route::delete('/marcas/{marca}', [MarcaController::class, 'destroy'])->name('marcas.destroy');
// Redireccionar para editar la marcas
Route::get('/marcas/{marca}/edit', [MarcaController::class, 'edit'])->name('marcas.edit');
Route::post('/marcas/images', [ImagenController::class, 'store'])->name('marcas_imagenes.store');
// Actualizar la marcas
Route::put('/marcas/{marca}', [MarcaController::class, 'update'])->name('marcas.update');
Route::put('/marcas/{marca}/update-imagen', [MarcaController::class, 'updateImagen'])->name('marcas.update_imagen');


Route::get('/subcategorias/create', [SubcategoriaController::class, 'create'])->name('subcategorias.create');
// Crea el registro de la subcategoría
Route::post('/subcategorias', [SubcategoriaController::class, 'store'])->name('subcategorias.store');
// Redirecciona para ver el contenido en la vista de show de la subcategoría
Route::get('/subcategorias', [SubcategoriaController::class, 'show'])->name('subcategorias.show');
// Redirecciona al dashboard después de haber eliminado la subcategoría
Route::delete('/subcategorias/{id}', [SubcategoriaController::class, 'destroy'])->name('subcategorias.destroy');
// Redireccionar para editar la subcategoría
Route::get('/subcategorias/{subcategoria}/edit', [SubcategoriaController::class, 'edit'])->name('subcategorias.edit');
// Actualizar la subcategoría
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
//redirecciona para editar las devolucciones ventas
Route::get('/devoluciones/{devolucion}/edit', [DevolucionController::class, 'edit'])->name('devoluciones.edit');
// Actualizar la categoría
Route::put('/devoluciones/{id}/edit', [DevolucionController::class, 'update'])->name('devoluciones.update');


Route::get('/ventas/create', [VentaController::class, 'create'])->name('ventas.create');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas', [VentaController::class, 'show'])->name('ventas.show');
Route::get('/ventas/{venta}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
Route::put('/ventas/{venta}', [VentaController::class, 'update'])->name('ventas.update');
Route::delete('/ventas/{venta}', [VentaController::class, 'destroy'])->name('ventas.destroy');

Route::get('/clientes', [ClienteController::class, 'show'])->name('clientes.show');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes/images', [ImagenController::class, 'store'])->name('clientes_imagenes.store');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::put('/marcas/{cliente}/update-imagen', [ClienteController::class, 'updateImagen'])->name('clientes.update_imagen');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::get('/proveedores', [ProveedorController::class, 'show'])->name('proveedores.show');
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
Route::delete('/proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');