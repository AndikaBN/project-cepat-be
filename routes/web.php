<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\SalePiutangController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DataOtletController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TokoController;

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
    Route::resource('tagihan', TagihanController::class);
    Route::resource('checkin', CheckInController::class);

    Route::get('/sale-piutang/truncate', [SalePiutangController::class, 'truncate'])->name('salePiutang.truncate');
    Route::get('/user/{userId}/checkins/maps', [CheckInController::class, 'viewMapsByUserId'])->name('user.checkins.maps');
    Route::get('/ajax/user/{userId}', [CheckInController::class, 'ajaxByUserId'])->name('ajax.user');

    // Route::get('/user-checkins-locations/{userId}', [CheckInController::class, 'userCheckinLocations'])->name('checkins.user.locations');
    Route::get('checkins/user/{userId}/locations', [CheckInController::class, 'userCheckinLocations'])->name('checkins.user.locations');

    Route::get('/user-checkins/{userId}', [CheckInController::class, 'viewMapsByUserId'])->name('checkins.user.maps');
    Route::delete('/checkins/{id}', [CheckInController::class, 'hapus'])->name('checkins.hapus');


    // Route::get('/user-checkins-locations/{userId}', [CheckInController::class, 'userCheckinLocations'])->name('checkins.user.locations');
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
        return view('marketings.pages.dashboard');
    })->name('marketing');

    Route::resource('stock', StockController::class);
    Route::get('/stocks/truncate', [StockController::class, 'truncateTable'])->name('stocks.truncate');
    Route::resource('toko', TokoController::class);
    Route::get('export/toko', [TokoController::class, 'export'])->name('toko.export');
    Route::post('import/toko', [TokoController::class, 'import'])->name('toko.import');
    Route::get('export/stock', [StockController::class, 'export'])->name('stock.export');
    Route::post('import/stock', [StockController::class, 'import'])->name('stock.import');

    //create route dataotlet
    Route::get('/data-otlet/truncate', [DataOtletController::class, 'truncate'])->name('dataOtlet.truncate');
    Route::resource('dataOtlet', DataOtletController::class);
    Route::get('export/dataOtlet', [DataOtletController::class, 'export'])->name('dataOtlet.export');
    Route::post('import/dataOtlet', [DataOtletController::class, 'import'])->name('dataOtlet.import');
});

//create route for role inputers
Route::middleware(['auth', 'role:inputer,owner'])->group(function () {
    Route::get('inputers', function () {
        return view('inputers.pages.dashboard');
    })->name('inputers');

    Route::resource('orders', OrderController::class);
});
