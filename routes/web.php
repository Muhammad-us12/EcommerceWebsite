<?php

use App\Enums\UserRoles;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes for users with 'admin' role
Route::prefix('admin')
    ->middleware([
        'auth',
        'role:'.UserRoles::ADMIN->value.'',
        config('jetstream.auth_session'),
        'verified'])
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Categories
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'getAllCategories'])->name('categoryList.list');
            Route::get('/sub-categories', [CategoryController::class, 'getAllSubCategories'])->name('categoryList.list');
            Route::get('/{category}', [CategoryController::class, 'getCategory']);
            Route::post('/store', [CategoryController::class, 'addCategory']);
            Route::post('/update', [CategoryController::class, 'updateCategory'])->name('category.update');
        });

        // Brands
        Route::prefix('brand')->group(function () {
            Route::get('/', [BrandController::class, 'getAllBrands'])->name('brands.list');
            Route::get('/{brand}', [BrandController::class, 'getBrand']);
            Route::post('/store', [BrandController::class, 'addBrand']);
            Route::post('/update', [BrandController::class, 'updateBrand'])->name('brand.update');
        });

    });

Route::middleware([
    'auth:sanctum',
    'role.redirect',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

include_once 'customer.php';
include_once 'vendor.php';
