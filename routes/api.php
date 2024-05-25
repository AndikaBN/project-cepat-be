<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// api login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

// api logout
Route::middleware('auth:sanctum')->post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

// api register
Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

// api outlets
Route::middleware('auth:sanctum')->get('/outlets', [App\Http\Controllers\Api\OutletController::class, 'index']);

// api store outlet
Route::middleware('auth:sanctum')->post('/outlets', [App\Http\Controllers\Api\OutletController::class, 'store']);
