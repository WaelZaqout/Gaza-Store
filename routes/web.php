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
use App\Http\Controllers\StripeWebhookController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    // الصفحات الرئيسية
    Route::get('/', [FrontController::class, 'index'])->name('front.index');
    Route::get('/products', [FrontController::class, 'products'])->name('front.products');
    Route::get('/products/{id}', [FrontController::class, 'show']);
    Route::get('/filter-products/{id}', [FrontController::class, 'filterProducts']);
    Route::get('/product/{id}', [FrontController::class, 'getProduct']);
    Route::get('/category/{id}', [FrontController::class, 'category'])->name('front.category');
    Route::get('/shoping', [FrontController::class, 'shoping'])->name('front.shoping');
    Route::get('/blog', [FrontController::class, 'blog'])->name('front.blog');
    Route::get('/about', [FrontController::class, 'about'])->name('front.about');
    Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');
    Route::get('/footer', [FrontController::class, 'footer'])->name('front.footer');
    Route::post('/search', [FrontController::class, 'search'])->name('search');

    // المسارات المحمية بالمصادقة
    Route::middleware(['auth'])->group(function () {

        // المفضلة
        Route::prefix('favorites')->group(function () {
            Route::get('/', [FavoriteController::class, 'favoritesPage'])->name('front.favorites');
            Route::post('/add', [FavoriteController::class, 'addToFavorite'])->name('front.favorites.add');
            Route::post('/toggle', [FavoriteController::class, 'toggleFavorite'])->name('front.favorites.toggle');
            Route::delete('/remove/{id}', [FavoriteController::class, 'removeFromfavorites'])->name('favorites.remove');
            Route::post('/is-favorite', [FavoriteController::class, 'isFavorite'])->name('front.favorites.isFavorite');
            Route::get('/count', [FavoriteController::class, 'getFavoritesCount'])->name('front.favorites.count');
        });

        // السلة
        Route::prefix('carts')->group(function () {
            Route::post('/add', [CartController::class, 'addToCart'])->name('front.carts.add');
            Route::post('/toggle', [CartController::class, 'toggleCart'])->name('front.carts.toggle');
            Route::delete('/remove/{id}', [CartController::class, 'removeFromcart'])->name('carts.remove');
            Route::post('/is-cart', [CartController::class, 'isCart'])->name('front.carts.isCart');
            Route::get('/', [CartController::class, 'cartsPage'])->name('front.carts');
            Route::get('/count', [CartController::class, 'getCartsCount'])->name('front.carts.count');
        });

        // الحساب الشخصي
        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    });

    // الدفع
    Route::prefix('checkout')->group(function () {
        Route::get('/', [PaymentController::class, 'checkout'])->name('checkout');
        Route::post('/', [FrontController::class, 'checkoutpage'])->name('checkout.page');
        Route::get('/success', function () { return view('front.checkout.success'); })->name('checkout.success');
        Route::get('/canceled', function () { return view('front.checkout.canceled'); })->name('checkout.canceled');
        Route::post('/process', [PaymentController::class, 'processPayment'])->name('checkout.process');
    });


    // إدارة الإشعارات
    Route::post('stripe/webhook', [StripeWebhookController::class, 'handleWebhook']);

    Route::get('/dashboard', function () {
        return redirect()->route('front.index'); // توجيه إلى الصفحة الرئيسية بدلًا من لوحة التحكم
    })->middleware(['auth', 'verified'])->name('dashboard');

    require __DIR__.'/auth.php';
});
