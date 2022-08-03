<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/contact_form', [ContactController::class, 'create'])->name('contact_form');

Route::get('/order/{tracking_no}', [\App\Http\Controllers\TrackController::class, 'trackorder'])->name('trackorder');


Route::get('/cart', [CartController::class, 'index'])->name('cartIndex');
Route::post('/cart', [CartController::class, 'store'])->name('cartStore');
Route::post('/cart/remove', [CartController::class, 'destroy'])->name('cartDestroy');
Route::post('/cart/update', [CartController::class, 'update'])->name('cartUpdate');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cartClear');

Route::get('/cart/checkout', [CheckoutController::class, 'checkout'])->name('productCheckout');;
Route::post('/place-order', [CheckoutController::class, 'placeorder'])->name('placeorder');

Route::post('/contact', [ContactController::class, 'store']);
Route::get('/{cat}/{product}', [ProductController::class, 'show'])->name('showProduct');
Route::get('/{cat}', [ProductController::class, 'showCategory'])->name('showCategory');

