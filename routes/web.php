<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\SalePiutangController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DataOtletController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('auth.pages.login');
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('home', function () {
        return view('owner.pages.dashboard');
    })->name('home');
    Route::resource('users', UserController::class);
    Route::resource('outlets', OutletController::class);
    Route::resource('checkins', CheckInController::class);
    Route::resource('salesPiutang', SalePiutangController::class);
    Route::get('export/salesPiutang', [SalePiutangController::class, 'export'])->name('salesPiutang.export');
    Route::post('import/salesPiutang', [SalePiutangController::class, 'import'])->name('salesPiutang.import');
});

Route::middleware(['auth', 'role:kolektor,owner'])->group(function () {
    Route::get('kolektor', function () {
        return view('kolektor.pages.dashboard');
    })->name('kolektor');
});

// create route fot role marketing
Route::middleware(['auth', 'role:marketing,owner'])->group(function () {
    Route::get('marketing', function () {
        return view('marketing.pages.dashboard');
    })->name('marketing');

    Route::resource('stock', StockController::class);
    Route::get('export/stock', [StockController::class, 'export'])->name('stock.export');
    Route::post('import/stock', [StockController::class, 'import'])->name('stock.import');

    //create route dataotlet
    Route::resource('dataOtlet', DataOtletController::class);
    Route::get('export/dataOtlet', [DataOtletController::class, 'export'])->name('dataOtlet.export');
    Route::post('import/dataOtlet', [DataOtletController::class, 'import'])->name('dataOtlet.import');
});

//create route for role inputers
Route::middleware(['auth', 'role:inputer,owner'])->group(function(){
    Route::get('inputers', function(){
        return view('inputers.pages.dashboard');
    })->name('inputers');

    Route::resource('orders', OrderController::class);
});
