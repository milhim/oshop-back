<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ShoppingCartController;

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
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::post('/send-password-reset-link', [ResetPasswordController::class, 'sendResetEmail']);
    Route::post('/password-reset', [ChangePasswordController::class, 'changePassword']);
    //get user name
    Route::get('/username', [AuthController::class, 'me']);
    //categories
    Route::get('/categories',[CategoryController::class,'index']);
    //product 
    Route::post('/products',[ProductController::class,'create']);
    Route::get('/products',[ProductController::class,'index']);
    Route::get('/products/{id}',[ProductController::class,'show']);
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'delete']);
//shopping cart
    Route::post('/shopping-cart',[CartController::class,'create']);
    Route::put('/shopping-cart',[CartController::class,'update']);
    Route::get('/shopping-cart-item/{id}',[CartController::class,'show']);
    Route::get('/shopping-cart',[CartController::class,'index']);
    Route::post('/shopping-cart/remove',[CartController::class,'remove']);
    Route::get('/shopping-cart-products/{id}',[CartController::class,'getProducts']);
    Route::delete('/shopping-cart/{id}',[CartController::class,'destroy']);
//cart product
    Route::get('/shopping-cart/{id}',[CartProductController::class,'show']);

    //order
    Route::post('/order',[OrderController::class,'create']);

});
