<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('product/store',[ProductController::class,'store']);
    Route::put('product/update/{id}',[ProductController::class,'update']);
    Route::delete('product/delete/{id}',[ProductController::class,'destroy']);
    Route::post('logout/',[AuthController::class,'logout']);
});

//public routes
Route::post('register/',[AuthController::class,'register']);
Route::post('login/',[AuthController::class,'login']);
Route::post('products/',[ProductController::class,'index']);
Route::get('product/show/{id}',[ProductController::class,'show']);

