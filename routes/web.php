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
Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

Route::get('add/cart/{id}',[\App\Http\Controllers\Frontend\CartController::class,'cartAdd'])->name('cart.add');
Route::get('cart/',[\App\Http\Controllers\Frontend\CartController::class,'cart'])->name('cart');

Route::get('login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('login', [\App\Http\Controllers\LoginController::class, 'login']);
Route::get('register',[\App\Http\Controllers\Frontend\UserController::class,'register'])->name('register');
Route::post('register',[\App\Http\Controllers\Frontend\UserController::class,'doRegister']);


Route::middleware('auth')->group(function () {
    Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::get('profile',[\App\Http\Controllers\Frontend\UserController::class,'profile'])->name('profile');
    Route::post('profile',[\App\Http\Controllers\Frontend\UserController::class,'updateProfile']);

    Route::get('checkout',[\App\Http\Controllers\Frontend\OrderController::class,'checkout'])->name('checkout');
    Route::post('checkout',[\App\Http\Controllers\Frontend\OrderController::class,'order']);
    Route::get('order/{id}',[\App\Http\Controllers\Frontend\OrderController::class,'show'])->name('order.show');

    Route::middleware('isAdmin')->group(function () {
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
    });
});




