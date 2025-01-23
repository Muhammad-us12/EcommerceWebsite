<?php

use App\Enums\UserRoles;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorOnBoardingController;
use App\Http\Controllers\VendorOrderController;
use App\Http\Controllers\VendorProductController;
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
            Route::get('/', [VendorProductController::class, 'index'])->name('product.index');
            Route::get('/{product}', [VendorProductController::class, 'edit']);
            Route::get('/{product}/gallery', [VendorProductController::class, 'getGallery']);
            Route::post('/{product}/gallery', [VendorProductController::class, 'saveProductGallery']);
            Route::post('/store', [VendorProductController::class, 'store']);
            Route::post('/update/{product}', [VendorProductController::class, 'update'])->name('vendor.product.update');
            Route::post('/destroy', [VendorProductController::class, 'destroy'])->name('product.destroy');
        });

        // Categories
        Route::prefix('categories')->group(function () {
            Route::get('/{category}/sub-categories', [CategoryController::class, 'fetchSubCategory']);
        });

        Route::get('/order-list', [VendorOrderController::class, 'index']);
        Route::get('/orders/{order}', [VendorOrderController::class, 'show']);

    });
