<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});







/*Backend */
Route::prefix('administracion')->group(function () {
    Route::get('/', function () {
        return view('backend.home');
    });
    Route::get('/categorias','IndexBackendController@indexCategoria');
    Route::get('/sub-categorias', 'IndexBackendController@indexSub');
    Route::get('/marcas',  'IndexBackendController@indexMarca');
    Route::get('/estilos', 'IndexBackendController@indexEstilo');
    Route::get('/colores', 'IndexBackendController@indexColor');
    Route::get('/tallas', 'IndexBackendController@indexTalla');
    Route::get('/productos', 'IndexBackendController@indexProducto');
    Route::get('/ofertas', 'IndexBackendController@indexOferta');
    Route::get('/metodos-pagos', 'IndexBackendController@indexMetodo');
    Route::get('/proveedores','IndexBackendController@indexProveedor');
    Route::get('/inventarios','IndexBackendController@indexInventario');
    Route::get('/ventas','IndexBackendController@indexVenta');
    Route::get('/pedidos','IndexBackendController@indexPedido');
    Route::get('/banners','IndexBackendController@indexBanner');
    
});
/*End Backend */

