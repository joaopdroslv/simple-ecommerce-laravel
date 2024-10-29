<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/products', [ProductController::class, 'getAllProducts'])->name('products.allProducts');
Route::get('/products/category/{id}', [ProductController::class, 'getProductsByCategoryId'])->name('products.byCategoryId');
Route::get('/products/filter', [ProductController::class, 'getProductsByFilter'])->name('products.filter');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
