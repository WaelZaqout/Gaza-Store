<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SilderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group(
    ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
    function () {
        Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminController::class, 'profile_data'])->name('profile_data');
        Route::post('/check-profile', [AdminController::class, 'check_password'])->name('check_password');


            Route::resource('categories', CategoryController::class);
            Route::resource('products', ProductController::class);
            Route::resource('silders',SilderController::class);


            Route::get(('/delete->image/{id?}'), [ProductController::class, 'delete_img'])->name('delete_img');


//
});
});
