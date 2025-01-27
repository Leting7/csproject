<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Auth\JWTAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaController;




Route::prefix('posts')->middleware('auth:sanctum')->controller(PostController::class)->group(function () {

    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('view/{id}', 'show');
    Route::post('/update/{id}', 'update');
    Route::post('/delete/{id}', 'delete');
});


Route::prefix('users')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});


# Product
// -
Route::prefix('products')->controller(ProductController::class)->middleware('auth:jwt_auth')->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::get('view/{id}', 'view');
    Route::post('delete/{id}', 'delete');
});


# JWT Auth
Route::controller(JWTAuthController::class)->group(function () {

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:jwt_auth')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'me');
    });
});

// Route::post('validation', [MpesaResponsesController::class,'validation']);
// Route::post('confirmation', [MpesaResponsesController::class,'confirmation']);
// Route::post('stkpush',[MpesaResponsesController::class,'stkPush']);

// Route::post('v1/access/token', [MpesaController::class,'generateAccesToken']);
// Route::post('v1/hlab/stk/push', [MpesaController::class,'stkPush']);

Route::post('/mpesa/stkpush/response', [MpesaController::class, 'resData'])->name('stkpush.response');