<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login.index');
    Route::post('login', 'store')->name('login.store');
    Route::get('register', 'register')->name('login.register');
    Route::post('register', 'create')->name('login.create');
    Route::get('logout', 'destroy')->name('login.destroy');
});

Route::get('/products/all', [ProductController::class, 'getAll'])->name('products.getAll');
Route::get('/products/by-category/{id}', [ProductController::class, 'getByCategoryId'])->name('products.byCategoryId');
Route::get('/products/filter', [ProductController::class, 'getByFilter'])->name('products.byFilter');
Route::get('/products/{product}/detail', [ProductController::class, 'detail'])->name('products.detail');

Route::resource('products', ProductController::class)->middleware('auth');

Route::get('/shopping-cart', [CartController::class, 'showCart'])->middleware('auth')->name('carts.showCart');
Route::post('/shopping-cart/add/{product}', [CartController::class, 'addToCart'])->middleware('auth')->name('carts.addToCart');
