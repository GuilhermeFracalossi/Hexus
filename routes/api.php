<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;

use Illuminate\Http\Request;
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


Route::apiResource('products', ProductController::class);

Route::apiResource('users', UserController::class);

Route::apiResource('categories', CategoryController::class);

Route::apiResource('orders', OrderController::class);

//Route::delete('users/deleteMultiple', [UserController::class, 'destroyMultiple']);


//Route::delete('categories/deleteMultiple', [CategoryController::class, 'destroyMultiple']);



