<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\CartController;
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


Route::view('/', 'home')->name('home');


Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'IsAdmin'])->name('dashboard');
require __DIR__ . '/auth.php';



Route::view('/dashboard/{any}', 'dashboard')
    ->middleware(['auth', 'IsAdmin'])
    ->where('any', '.*');



Route::view('/product/{id}', 'home')->where('id', '.*');

Route::view('products/{category}', 'home');
Route::view('search', 'home');



Route::view('/cart', 'home');

Route::get('/cart/list', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'insert']);

Route::put('/cart/{id}', [CartController::class, 'updateQuantity']);

Route::delete('/cart/all', [CartController::class, 'deleteCart']);
Route::delete('/cart/{id}', [CartController::class, 'removeItem']);

Route::view('/checkout', 'home')->middleware(['auth']);
Route::view('/confirmed', 'home')->middleware(['auth']);