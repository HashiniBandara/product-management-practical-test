<?php

use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/products', [ProductApiController::class, 'index']);
Route::get('/products/{id}', [ProductApiController::class, 'show']);
Route::post('/products', [ProductApiController::class, 'store']);
Route::put('/products/{id}', [ProductApiController::class, 'update']);
Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);


// JWT LOGIN
Route::post('/login', [AuthApiController::class, 'login']);

// PROTECTED routes using JWT
// Route::middleware('auth.jwt')->group(function () {

//     Route::get('/products', [ProductApiController::class, 'index']);
//     Route::get('/products/{id}', [ProductApiController::class, 'show']);
//     Route::post('/products', [ProductApiController::class, 'store']);
//     Route::put('/products/{id}', [ProductApiController::class, 'update']);
//     Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

//     Route::get('/user', [AuthApiController::class, 'user']);
//     Route::post('/logout', [AuthApiController::class, 'logout']);
// });

// Protected routes using JWT guard
Route::middleware('auth:api')->group(function () {
    // Route::get('/products', [ProductApiController::class, 'index']);
    // Route::get('/products/{id}', [ProductApiController::class, 'show']);
    // Route::post('/products', [ProductApiController::class, 'store']);
    // Route::put('/products/{id}', [ProductApiController::class, 'update']);
    // Route::delete('/products/{id}', [ProductApiController::class, 'destroy']);

    // Route::get('/user', [AuthApiController::class, 'user']);
    Route::post('/logout', [AuthApiController::class, 'logout']);
});
