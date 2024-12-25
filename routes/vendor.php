<?php

use App\Enums\UserRoles;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorOnBoardingController;
use App\Http\Controllers\VendorOrderController;
use Illuminate\Support\Facades\Route;

// Routes for users with 'user' role
Route::prefix('vendor')
    ->middleware([
        'auth',
        'role:'.UserRoles::VENDOR->value.'',
        config('jetstream.auth_session'),
        'verified'])
    ->group(function () {

        Route::get('/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');

        Route::prefix('on-boarding')->group(function () {
            Route::get('/', [VendorOnBoardingController::class, 'index'])->name('vendor.onboarding');
            Route::post('/save', [VendorOnBoardingController::class, 'store']);
            Route::post('/update/{vendor}', [VendorOnBoardingController::class, 'update']);

        });

        // Product
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/{product}', [ProductController::class, 'show']);
            Route::get('/{product}/gallery', [ProductController::class, 'getGallery']);
            Route::post('/{product}/gallery', [ProductController::class, 'saveProductGallery']);
            Route::post('/store', [ProductController::class, 'store']);
            Route::post('/update', [ProductController::class, 'update']);
            Route::post('/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
        });

        Route::get('/order-list', [VendorOrderController::class, 'index']);
        Route::get('/orders/{order}', [VendorOrderController::class, 'show']);

    });
