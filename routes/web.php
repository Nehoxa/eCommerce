<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\StripeCheckoutController;

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

Route::get('/checkout', [StripeCheckoutController::class, 'create']);
Route::post('/paymentIntent', [StripeCheckoutController::class, 'paymentIntent']);

Route::post('/saveOrder', OrderController::class)
    ->name('orders.save');

Route::get('/shoppingCart', ShoppingCartController::class)
    ->name('cart.index');

Route::get('/', [ProductController::class, 'index'])
    ->name('products.index');

require __DIR__.'/auth.php';
