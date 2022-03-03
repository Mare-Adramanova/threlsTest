<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'] )->name('products.index');
Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'] )->name('product.show');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'] )->name('product.create');
Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'] )->name('product.destroy');
Route::put('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'] )->name('product.update');

Route::get('/cart/{product}/{quantity}', [App\Http\Controllers\CartController::class, 'index'] )->name('cart.index');
Route::delete('/cart/{product}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
Route::put('/cart/{product}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');
Route::get('/cart', function () {
    return response()->json(Cache::get('cart'));
});