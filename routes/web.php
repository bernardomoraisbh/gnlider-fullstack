<?php

use App\Http\Controllers\Admin\AdminIndexController;
use App\Http\Controllers\Admin\AdminCountryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminSexController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

// ADMIN ROUTES
// Route::resource('admin', AdminIndexController::class);
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('country', AdminCountryController::class);
    Route::resource('product', AdminProductController::class);
    Route::resource('brand', AdminBrandController::class);
    Route::resource('sex', AdminSexController::class);
});

// EXTERNAL ROUTES
Route::get('/', [IndexController::class, 'index']);
Route::get('/show', [IndexController::class, 'show']);

Route::resource('listing', ListingController::class);
