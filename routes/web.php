<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OutletController;


Route::get('/', function () {
    return view('auth.pages.login');
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('home', function () {
        return view('owner.pages.dashboard');
    })->name('home');
    Route::resource('users', UserController::class);
    Route::resource('outlets', OutletController::class);
});

Route::middleware(['auth', 'role:kolektor,owner'])->group(function () {
    Route::get('kolektor', function () {
        return view('kolektor.pages.dashboard');
    })->name('kolektor');
});
