<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

/* Front */
Auth::routes(['verify' => true]);
Route::group(['middleware' => 'isVerfied'], function() { 

    Route::get('/', function () {
        return view('frontend.layouts.home');
    });
    
    Route::get('/sobre-nosotros', function () {
        return view('frontend.layouts.about');
    })->name('about.us');
    
    Route::get('/contactanos', function () {
        return view('frontend.layouts.contact');
    })->name('contact.us');
    
    Route::get('/productos/{categoria}', function ($categoria) {
        return view('frontend.layouts.main-product', ['title' => $categoria]);
    })->name('product.views');
    
    Route::get('/productos/{categoria}/{subCategoria}', function ($categoria, $subCategoria) {
        return view('frontend.layouts.product', ['title' => $categoria, 'subTitle' => $subCategoria]);
    })->name('product.filter');
    
    Route::get('/productos/{categoria}/{subCategoria}/{producto}', function ($categoria, $subCategoria, $producto) {
        return view('frontend.layouts.product-detail', ['title' => $categoria, 'subTitle' => $subCategoria, 'producto' => $producto]);
    })->name('product.detail');

    Route::get('/perfil', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth')->name('perfil');
    
    Route::get('/carrito', function () {
        return view('frontend.layouts.cart');
    })->middleware('cartVerify')->name('cart');

    Route::get('/checkout', function () {
        return view('frontend.layouts.checkout');
    })->middleware(['cartVerify', 'auth'])->name('checkout');
});

Route::get('/email-validation', function () {
    return view('frontend.emails.confirmation-email');
})->middleware('auth')->name('email.validation');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/* End Front */

Auth::routes();

Route::get('/login', function () {
    return view('auth.iniciar-sesion');
})->name('login');

Route::get('/register', function () {
    return view('auth.registrar');
})->name('register');

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */




/*Backend */
Route::prefix('administracion')->middleware(['auth','typeuser'])->group(function () {
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
    Route::get('/materiales','IndexBackendController@indexMaterial');
    
});
/*End Backend */