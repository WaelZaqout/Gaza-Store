<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SilderController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath'
        ]
    ],
    function () {
        // نستخدم middleware 'auth' + 'role:admin'
        Route::prefix('admin')
            ->name('admin.')
            ->middleware(['auth', 'role:admin'])
            ->group(function () {

                Route::get('/', [AdminController::class, 'index'])->name('index');
                Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
                Route::put('/profile', [AdminController::class, 'profile_data'])->name('profile_data');
                Route::post('/check-profile', [AdminController::class, 'check_password'])->name('check_password');
                Route::get('/index/stats', [AdminController::class, 'getIndexStats']);
                Route::get('/chart-data', [AdminController::class, 'getChartData']);

                Route::resource('categories', CategoryController::class);
                Route::resource('products', ProductController::class);
                Route::resource('orders', OrderController::class);
                Route::resource('invoices', InvoiceController::class);
                Route::resource('silders', SilderController::class);
                Route::resource('customers', CustomerController::class);

                // يُفضل إصلاح اسم المسار لتجنب استخدام '->'
                Route::get('/delete-image/{id?}', [ProductController::class, 'delete_img'])->name('delete_img');

                Route::get('/orders/{id}/details', [OrderController::class, 'order_details'])->name('orders.details');
                Route::get('/invoices/{id}/details', [InvoiceController::class, 'invoice_details'])->name('invoice.details');
                Route::get('/invoice/print/{id}', [InvoiceController::class, 'printInvoice'])->name('invoice.print');

            });
    }
);
