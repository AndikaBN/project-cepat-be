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
Route::middleware('auth:sanctum')->post('/checkin', [App\Http\Controllers\Api\CheckInController::class, 'postCheckin']);

// api get checkin
Route::middleware('auth:sanctum')->get('/checkin', [App\Http\Controllers\Api\CheckInController::class, 'getCheckin']);

// api get checkin by id
Route::middleware('auth:sanctum')->get('/checkin/{id}', [App\Http\Controllers\Api\CheckInController::class, 'getCheckinById']);

// api update checkin
Route::middleware('auth:sanctum')->put('/checkin/{id}', [App\Http\Controllers\Api\CheckInController::class, 'updateCheckin']);

// api delete checkin
Route::middleware('auth:sanctum')->delete('/checkin/{id}', [App\Http\Controllers\Api\CheckInController::class, 'deleteCheckin']);

// api salePiutang
Route::middleware('auth:sanctum')->get('/salePiutang', [App\Http\Controllers\Api\SalePiutangController::class, 'index']);

// api store salePiutang
Route::middleware('auth:sanctum')->post('/salePiutang', [App\Http\Controllers\Api\SalePiutangController::class, 'store']);

// api update salePiutang
Route::middleware('auth:sanctum')->put('/salePiutang/{id}', [App\Http\Controllers\Api\SalePiutangController::class, 'update']);

// api delete salePiutang
Route::middleware('auth:sanctum')->delete('/salePiutang/{id}', [App\Http\Controllers\Api\SalePiutangController::class, 'destroy']);

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

// api get order
Route::middleware('auth:sanctum')->get('/order', [App\Http\Controllers\Api\OrderController::class, 'index']);

// api store order
Route::middleware('auth:sanctum')->post('/order', [App\Http\Controllers\Api\OrderController::class, 'store']);

// api update order
Route::middleware('auth:sanctum')->put('/order/{id}', [App\Http\Controllers\Api\OrderController::class, 'update']);

// api delete order
Route::middleware('auth:sanctum')->delete('/order/{id}', [App\Http\Controllers\Api\OrderController::class, 'destroy']);

// api get tagihan
Route::middleware('auth:sanctum')->get('/tagihan', [App\Http\Controllers\Api\TagihanController::class, 'getTagihan']);

// api store tagihan
Route::middleware('auth:sanctum')->post('/tagihan', [App\Http\Controllers\Api\TagihanController::class, 'store']);

// api update tagihan
Route::middleware('auth:sanctum')->put('/tagihan/{id}', [App\Http\Controllers\Api\TagihanController::class, 'update']);
