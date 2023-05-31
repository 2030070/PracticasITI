<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StoreController;

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

//Ruta para la pagina donde se muestra el registro y logueo de usuarios
Route::get('/', [HomeController::class, 'index'])->name('home');
//Ruta para el dashboard
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
//Ruta para la vista de registro de usuarios
Route::get('/register', [RegisterController::class, 'register_view'])->name('register');
//Ruta para registrar usuarios
Route::post('/register', [RegisterController::class, 'register_user'])->name('register.user');
//Ruta para la vista de logueo de usuarios
Route::get('/login', [RegisterController::class, 'login_view'])->name('login');
Route::post('/login', [RegisterController::class, 'login_user'])->name('login.user');
//Ruta para desloguear usuarios
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
//Ruta para ridereccionar al dasboard de productos
Route::get('/products', [StoreController::class, 'products_table'])->name('products');
//Ruta para ridereccionar al dasboard de usuarios
Route::get('/users', [StoreController::class, 'users_table'])->name('users');
//Ruta para la vista de registro de productos
Route::get('/register_product', [RegisterController::class, 'register_product_view'])->name('register_product');
//Ruta para registar productos
Route::post('/register_product', [RegisterController::class, 'add_product'])->name('add_product');
//Ruta para la vista de eliminar productos
Route::get('/delete_product', [RegisterController::class, 'delete_product_view'])->name('delete_product');
//Ruta para eliminar productos
Route::delete('/delete_product/{id}', [RegisterController::class, 'delete_product_table'])->name('delete_product_table');
