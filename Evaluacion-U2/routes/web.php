<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmpresaEmisoraController;
use App\Http\Controllers\EmpresaReceptoraController;

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

//Rutas para empresas emisoras
Route::get('/empresas_emisoras/create', [EmpresaEmisoraController::class, 'create'])->name('empresas_emisoras.create');
//rutas para consultar el listado de empresas emisoras
Route::get('/empresas_emisoras', [EmpresaEmisoraController::class, 'index'])->name('empresas_emisoras.index');
//Ruta para que el contenido se regisre de manera correcta para empresas emisoras
Route::post('/empresas_emisoras', [EmpresaEmisoraController::class, 'store'])->name('empresas_emisoras.store');

//Rutas para empresas receptoras
Route::get('/empresas_receptoras/create', [EmpresaReceptoraController::class, 'create'])->name('empresas_receptoras.create');
//ruta para consultar el listado de empresas receptoras
Route::get('/empresas_receptoras', [EmpresaReceptoraController::class, 'index'])->name('empresas_receptoras.index');
//Ruta para que el contenido se registre de manera correcta para empresas receptoras
Route::post('/empresas_receptoras', [EmpresaReceptoraController::class, 'store'])->name('empresas_receptoras.store');




