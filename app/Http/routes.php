<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

// Marcas
Route::resource('administracion/marca','MarcaController');
// Modelos
Route::resource('administracion/modelo','ModeloController');
// Proveedores
Route::resource('administracion/proveedor','ProveedorController');
// Vehiculos
Route::resource('administracion/vehiculo','VehiculoController');




/* /////////////////////////////////////////////////////////////////// Para borrar  ////////////////////////////////////////////////////
Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/producto','ProductoController');
Route::resource('ventas/cliente','ClienteController');
//Route::resource('compras/proveedor','ProveedorController');
Route::resource('compras/compra','CompraController');
Route::resource('ventas/venta','VentaController');
Route::resource('seguridad/usuario','UsuarioController');
Route::resource('ctacte/producto','ProductoController');
Route::resource('compras/pagos','PagosComprasController');

Route::get('pdf','PdfController@index');
Route::get('crear_reporte_categorias/{tipo}', 'PdfController@crear_reporte_categorias');
Route::get('crear_reporte_cuentasxcobrar/{tipo}', 'PdfController@crear_reporte_cuentasxcobrar');
Route::get('crear_reporte_cuentasxcobrar_vcto/{tipo}', 'PdfController@crear_reporte_cuentasxcobrar_vcto');
Route::get('crear_reporte_cuentasxcobrar_producto/{tipo}', 'PdfController@crear_reporte_cuentasxcobrar_producto');
Route::get('crear_reporte_productos/{tipo}', 'PdfController@crear_reporte_productos');
Route::get('crear_reporte_ventasxcliente/{tipo}', 'PdfController@crear_reporte_ventasxcliente');
Route::get('crear_reporte_clientes/{tipo}', 'PdfController@crear_reporte_clientes');
Route::get('crear_reporte_proveedores/{tipo}', 'PdfController@crear_reporte_proveedores');


// rutas para la consulta de ventas por cliente
Route::post('resultado_ventas', 'PdfController@resultado_consulta_ventas');
Route::get('consulta_ventas', 'VentaController@consulta');

// rutas para la consulta de ventas por productos
Route::post('resultado_productos', 'PdfController@resultado_consulta_productos');
Route::get('consulta_productos', 'ProductoController@consulta');

// rutas para la consulta de deuda por cliente
Route::post('resultado_deudaxcliente', 'PdfController@resultado_deuda_cliente');
Route::get('consulta_deudaxcliente', 'ClienteController@consulta');

// rutas para la consulta de Cta.Cte. x Producto
Route::post('resultado_ctactexproducto', 'PdfController@resultado_ctactexproducto');
Route::get('consulta_ctactexproducto', 'ProductoController@ver');
*/
Route::Auth();
Route::get('/logout','Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('welcome');
Route::get('/{slug?}', 'HomeController@index'); 

?>