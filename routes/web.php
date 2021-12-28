<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[\App\Http\Controllers\Frontend\HomeController::class,'index'])->name('home');

Route::prefix('dashboard')->group(function () {
    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('products')->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\ProductController::class, 'index'])->name('admin.product');
        Route::get('/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/create', [\App\Http\Controllers\Backend\ProductController::class, 'store']);
        Route::get('/edit/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('admin.product.edit');
        Route::post('/edit/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'update']);
        Route::get('/delete/{id}', [\App\Http\Controllers\Backend\ProductController::class, 'delete'])->name('admin.product.delete');
    });
});


