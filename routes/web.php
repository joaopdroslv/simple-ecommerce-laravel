<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('aboutUs');

Route::controller(LoginController::class)->group(function () {
    Route::get('login', 'index')->name('login.index');
    Route::post('login', 'store')->name('login.store');
    Route::get('register', 'register')->name('login.register');
    Route::post('register', 'create')->name('login.create');
    Route::get('logout', 'destroy')->name('login.destroy');
});

Route::get('/products/all', [ProductController::class, 'getAll'])->name('products.getAll');
Route::get('/products/category/{id}', [ProductController::class, 'getByCategoryId'])->name('products.byCategoryId');
Route::get('/products/filter', [ProductController::class, 'getByFilter'])->name('products.byFilter');
Route::get('/products/{product}/detail', [ProductController::class, 'detail'])->name('products.detail');

# Admin access only routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('/admin/products', ProductController::class);
Route::resource('/admin/users', UserController::class);

# Customer access only routes
Route::get('/shopping-cart', [CartController::class, 'showCart'])->name('carts.showCart');
Route::post('/shopping-cart/add-one/{product}', [CartController::class, 'addOneToCart'])->name('carts.addOne');
Route::post('/shopping-cart/remove-one/{product}', [CartController::class, 'removeOneFromCart'])->name('carts.removeOne');
Route::post('/shopping-cart/remove-all/{product}', [CartController::class, 'removeAllFromCart'])->name('carts.removeAll');
Route::post('/shopping-cart/clear', [CartController::class, 'clearCart'])->name('carts.clear');

Route::get('/wishlists', [WishlistController::class, 'index'])->name('wishlists.index');
Route::post('/wishlists/{product}/store', [WishlistController::class, 'store'])->name('wishlists.store');
Route::delete('/wishlists/{wishlist}/destroy', [WishlistController::class, 'destroy'])->name('wishlists.destroy');
Route::post('/wishlists/clear', [WishlistController::class, 'clear'])->name('wishlists.clear');

Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/address', [AddressController::class, 'index'])->name('addresses.index');
Route::get('/address/create', [AddressController::class, 'create'])->name('addresses.create');
Route::post('/address/store', [AddressController::class, 'store'])->name('addresses.store');
Route::get('/address/{address}/show', [AddressController::class, 'show'])->name('addresses.show');
Route::get('/address/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
Route::put('/address/{address}/update', [AddressController::class, 'update'])->name('addresses.update');
Route::delete('/address/{address}/destroy', [AddressController::class, 'destroy'])->name('addresses.destroy');

# Customer routes
Route::get('/orders', [OrderController::class, 'list'])->name('orders.list');
Route::get('/orders/{order}/detail', [OrderController::class, 'detail'])->name('orders.detail');
Route::post('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');

# Admin routes
Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders.index');
