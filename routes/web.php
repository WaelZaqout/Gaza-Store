<?php

use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\NotificationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('/favorites', [FrontController::class, 'favorites'])->name('front.favorites');

// تغيير المسار الخاص بالإضافة والتبديل:
Route::post('/favorites/add', [FavoriteController::class, 'addToFavorite'])->name('front.favorites.add');
Route::post('/favorites/toggle', [FavoriteController::class, 'toggleFavorite'])->name('front.favorites.toggle');

// مسار إزالة من المفضلة:
Route::delete('/favorites/remove/{id}', [FavoriteController::class, 'removeFromfavorites'])->name('favorites.remove');
Route::post('/favorites/is-favorite', [FavoriteController::class, 'isFavorite'])->name('front.favorites.isFavorite');
// عرض صفحة المفضلات
Route::get('/favorites', [FavoriteController::class, 'favoritesPage'])->name('front.favorites');

// API لاسترجاع عدد المفضلات (للاستخدام مع AJAX)
Route::get('/favorites/count', [FavoriteController::class, 'getFavoritesCount'])->name('front.favorites.count');
// // مسار لعدد المفضلة:
// Route::get('/favorites/count', function () {
//     $count = Favorite::where('user_id', auth()->id())->count(); // احصل على العدد للمستخدم الحالي
//     return response()->json(['count' => $count]);
// })->name('favorites.count');

Route::post('/search', [FrontController::class, 'search'])->name('search');

Route::get('/blog',[FrontController::class, 'blog'])->name('front.blog');
Route::get('/about',[FrontController::class, 'about'])->name('front.about');
Route::get('/contact',[FrontController::class, 'contact'])->name('front.contact');
Route::get('/footer',[FrontController::class, 'footer'])->name('front.footer');


Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// زيادة رقم السلة  حسب عدد المنتجات التي اضيفت للسلة
Route::get('/cart/count', function () {
    $cart = session('cart');
    $count = $cart ? count($cart) : 0;
    return response()->json(['count' => $count]);
});




Route::get('/checkout', function () {
    return view('front.checkout.checkout');
})->name('checkout.page');



Route::get('/checkout/success', function () {
    return view('front.checkout.success');
})->name('checkout.success');

Route::get('/checkout/canceled', function () {
    return view('front.checkout.canceled');
})->name('checkout.canceled');

Route::post('/checkout/process', [PaymentController::class, 'processPayment'])->name('checkout.process');


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

