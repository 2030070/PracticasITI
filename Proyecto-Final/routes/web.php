<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\DevolucionController;
use App\Http\Controllers\PuntoVentaController;
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
//Guardar imagen el registro de la categoría
Route::post('/categorias/images', [ImagenController::class, 'store'])->name('categorias_imagenes.store');
// editar imagen
Route::put('/categorias/{id}/update-imagen', [ImagenController::class, 'update'])->name('categorias.update_imagen');


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
Route::post('/productos/images', [ImagenController::class, 'store'])->name('productos_imagenes.store');
// Actualizar la productos
Route::put('/productos/{id}/edit', [ProductoController::class, 'update'])->name('productos.update');
Route::put('/productos/{producto}/update-imagen', [ImagenController::class, 'update'])->name('productos.update_imagen');
Route::get('/productos/{id}/detalle', [ProductoController::class, 'showDetails'])->name('productos.detalle');
Route::post('/importarProductos', [ProductoController::class, 'importarProductos'])->name('producto.importar');

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
Route::put('/marcas/{marca}/update-imagen', [ImagenController::class, 'update'])->name('marcas.update_imagen');


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
//Guardar imagen el registro de la categoría
Route::post('/subcategorias/images', [ImagenController::class, 'store'])->name('subcategoria_imagenes.store');
// editar imagen
Route::put('/subcategorias/{id}/update-imagen', [ImagenController::class, 'update'])->name('subcategorias.update_imagen');

Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');


// Redirecciona a las devolucciones ventas
Route::get('/devoluciones/create/{productoId}/{ventaId}', [DevolucionController::class, 'create'])->name('devoluciones.create');
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
Route::get('/ventas', [VentaController::class, 'show'])->name('ventas.show');
Route::post('/ventas', [VentaController::class, 'store'])->name('ventas.store');
Route::get('/ventas/punto-venta', [PuntoVentaController::class, 'index'])->name('puntoVenta.index');
Route::post('/ventas/guardar-compra', [PuntoVentaController::class, 'guardarCompra'])->name('guardar.compra');
Route::delete('/ventas/eliminar-venta/{id}', [PuntoVentaController::class, 'destroy'])->name('eliminar.venta');
Route::get('/ventas/detalle-venta/{id}', [PuntoVentaController::class, 'showDetalleVenta'])->name('ventas.detalle');
Route::get('/ventas/filtrar-productos', [PuntoVentaController::class, 'filtrarProductos'])->name('filtrar.productos');
Route::get('/ventas/lista-ventas', [VentaController::class, 'index'])->name('ventas.index');
// Eliminar la venta
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');

Route::get('/clientes', [ClienteController::class, 'show'])->name('clientes.show');
Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
Route::post('/clientes/images', [ImagenController::class, 'store'])->name('clientes_imagenes.store');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
Route::put('/marcas/{cliente}/update-imagen', [ImagenController::class, 'update'])->name('clientes.update_imagen');
Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

Route::get('/proveedores', [ProveedorController::class, 'show'])->name('proveedores.show');
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
Route::get('/proveedores/{proveedor}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update'])->name('proveedores.update');
Route::delete('/proveedores/{proveedor}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');

Route::get('/usuarios', [UsuariosController::class, 'show'])->name('usuarios.show');
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{usuario}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{usuario}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{usuario}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
Route::post('/usuarios/images', [ImagenController::class, 'store'])->name('usuarios_imagenes.store');
Route::put('/usuarios/{usuario}/update-imagen', [ImagenController::class, 'update'])->name('usuarios.update_imagen');

// Ruta para mostrar el listado de compras
Route::get('/compras/create', [CompraController::class, 'create'])->name('compras.create');
// Ruta para almacenar una nueva compra en la base de datos
Route::get('/compras/formulario/{producto}', [CompraController::class, 'formulario'])->name('compras.formulario');
Route::post('/compras', [CompraController::class, 'store'])->name('compras.store');
// Ruta para mostrar los detalles de una compra específica
Route::get('/compras', [CompraController::class, 'show'])->name('compras.show');
// Ruta para mostrar el formulario de edición de una compra específica
Route::get('/compras/{compra}/edit', [CompraController::class, 'edit'])->name('compras.edit');
// Ruta para actualizar una compra específica en la base de datos
Route::put('/compras/{compra}', [CompraController::class, 'update'])->name('compras.update');
// Ruta para eliminar una compra específica de la base de datos
Route::delete('/compras/{compra}', [CompraController::class, 'destroy'])->name('compras.destroy');




// Ruta para mostrar la tabla de cotizaciones
Route::get('/cotizaciones', [CotizacionController::class, 'mostrarCotizaciones'])->name('cotizaciones.show');
// Ruta para mostrar el formulario de cotización
Route::get('/cotizaciones/create', [CotizacionController::class, 'crearCotizacion'])->name('registrar-cotizacion-form');
// Ruta para filtrar productos por categoria de la cotización
Route::get('/filtrar-productos-cotizacion/{categoriaId}', [CotizacionController::class, 'filtrarProductosCotizacion'])->name('filtrar-productos-cotizacion');
// Ruta para generar una cotización
Route::post('/generar-cotizacion', [CotizacionController::class, 'registrarCotizacion'])->name('registrar-cotizacion-store');
// Ruta para agregar productos a la cotización
Route::post('/agregar-a-cotizacion', [CotizacionController::class, 'agregarProductoCotizacion'])->name('agregar-cotizacion');
// Ruta para eliminar productos de la cotización
Route::delete('/eliminar-de-cotizacion', [CotizacionController::class, 'eliminarProductoCotizacion'])->name('eliminar-cotizacion');
// Ruta para guardar la cotización
Route::post('/almacenar-cotizacion', [CotizacionController::class, 'almacenarCotizacion'])->name('cotizacion-store');
// Ruta para actualizar el estado de la cotización
Route::put('/actualizar-estado-cotizacion/{id}', [CotizacionController::class, 'actualizarEstadoCotizacion'])->name('actualizar-estado-cotizacion');

Route::post('/cotizaciones/agregar', [CotizacionController::class, 'agregar'])->name('cotizaciones.agregar');
Route::post('/cotizaciones/eliminar', [CotizacionController::class, 'eliminar'])->name('cotizaciones.eliminar');
Route::get('/cotizaciones/cart', [CotizacionController::class, 'cart'])->name('cotizaciones.cart');
Route::get('/cotizaciones/filtro', [CotizacionController::class, 'filtro'])->name('cotizaciones.filtro');
Route::get('/ventas/filtro', [VentaController::class, 'filtro'])->name('ventas.filtro');



Route::get('/download/{filename}', [DownloadController::class, 'downloadFile'])->name('download');
