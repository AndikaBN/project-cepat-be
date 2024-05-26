<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\CheckInController;
use App\Http\Controllers\Api\SaleController;

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

// api checkin
Route::middleware('auth:sanctum')->post('/checkin', [App\Http\Controllers\Api\CheckInController::class, 'checkin']);

// api get checkin
Route::middleware('auth:sanctum')->get('/checkin', [App\Http\Controllers\Api\CheckInController::class, 'getCheckin']);

// api get checkin by id
Route::middleware('auth:sanctum')->get('/checkin/{id}', [App\Http\Controllers\Api\CheckInController::class, 'getCheckinById']);

// api update checkin
Route::middleware('auth:sanctum')->put('/checkin/{id}', [App\Http\Controllers\Api\CheckInController::class, 'updateCheckin']);

// api delete checkin
Route::middleware('auth:sanctum')->delete('/checkin/{id}', [App\Http\Controllers\Api\CheckInController::class, 'deleteCheckin']);

// api sales
Route::middleware('auth:sanctum')->get('/sales', [App\Http\Controllers\Api\SaleController::class, 'index']);

// api store sales
Route::middleware('auth:sanctum')->post('/sales', [App\Http\Controllers\Api\SaleController::class, 'store']);

// api get sales by id
Route::middleware('auth:sanctum')->get('/sales/{id}', [App\Http\Controllers\Api\SaleController::class, 'show']);

// api update sales
Route::middleware('auth:sanctum')->put('/sales/{id}', [App\Http\Controllers\Api\SaleController::class, 'update']);

// api delete sales
Route::middleware('auth:sanctum')->delete('/sales/{id}', [App\Http\Controllers\Api\SaleController::class, 'destroy']);

// api get stock
Route::middleware('auth:sanctum')->get('/stock', [App\Http\Controllers\Api\StockController::class, 'index']);

// api store stock
Route::middleware('auth:sanctum')->post('/stock', [App\Http\Controllers\Api\StockController::class, 'store']);

// api update stock
Route::middleware('auth:sanctum')->put('/stock/{id}', [App\Http\Controllers\Api\StockController::class, 'update']);

// api delete stock
Route::middleware('auth:sanctum')->delete('/stock/{id}', [App\Http\Controllers\Api\StockController::class, 'destroy']);

// api get dataOtlet
Route::middleware('auth:sanctum')->get('/dataOtlet', [App\Http\Controllers\Api\DataOtletController::class, 'index']);

// api store dataOtlet
Route::middleware('auth:sanctum')->post('/dataOtlet', [App\Http\Controllers\Api\DataOtletController::class, 'store']);

// api update dataOtlet
Route::middleware('auth:sanctum')->put('/dataOtlet/{id}', [App\Http\Controllers\Api\DataOtletController::class, 'update']);

// api delete dataOtlet
Route::middleware('auth:sanctum')->delete('/dataOtlet/{id}', [App\Http\Controllers\Api\DataOtletController::class, 'destroy']);
