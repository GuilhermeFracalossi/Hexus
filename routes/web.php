<?php

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



Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'IsAdmin'])->name('dashboard');
require __DIR__ . '/auth.php';


Route::view('/dashboard/{any}', 'dashboard')
    ->middleware(['auth', 'IsAdmin'])
    ->where('any', '.*');


Route::view('/', 'home')->name('home');

Route::view('/product/{any}', 'home')->where('any', '.*');

Route::view('/cart', 'home');

Route::get('/cart/list', [CartController::class, 'index']);
Route::post('/cart', [CartController::class, 'insert']);

Route::delete('/cart', [CartController::class, 'delete']);