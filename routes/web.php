<?php

use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminCountryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminSexController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;

// ADMIN ROUTES
// Route::resource('admin', AdminIndexController::class);
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('country', AdminCountryController::class)->middleware('auth');
    Route::resource('product', AdminProductController::class)->middleware('auth');
    Route::resource('brand', AdminBrandController::class)->middleware('auth');
    Route::resource('sex', AdminSexController::class)->middleware('auth');
    Route::resource('user', AdminUserController::class)->middleware('auth');
});

// EXTERNAL ROUTES
Route::get('/', [IndexController::class, 'index'])->middleware('auth');
Route::get('index', [IndexController::class, 'index'])->middleware('auth');

Route::resource('listing', ListingController::class)->middleware('auth');

// USER
Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');


Route::resource('user-account', UserAccountController::class)->only(['create', 'store']);
