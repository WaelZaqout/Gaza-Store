<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;

Route::prefix(LaravelLocalization::setLocale())
->group(function () {


Route::get('/',[FrontController::class, 'index'])->name('front.index');


Route::get('/products',[FrontController::class, 'products'])->name('front.products');
Route::get('/products/{id}', [FrontController::class, 'show']);
Route::get('/filter-products/{id}', [FrontController::class, 'filterProducts']);
Route::get('/product/{id}', [FrontController::class, 'getProduct']);

Route::get('/category/{id}',[FrontController::class, 'category'])->name('front.category');

Route::get('/shoping',[FrontController::class, 'shoping'])->name('front.shoping');
Route::post('/shoping', [CartController::class, 'addToShoping'])->name('front.shoping');

Route::get('/favorites',[FrontController::class, 'favorites'])->name('front.favorites');
Route::post('/favorites', [FavoriteController::class, 'addToFavorite'])->name('front.favorites');

Route::get('/search', [FrontController::class, 'search'])->name('front.search');

Route::get('/search-products', [FrontController::class, 'searchProducts'])->name('products.search');


Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');













Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
});

