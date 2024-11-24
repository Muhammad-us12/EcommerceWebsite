<?php

use App\Enums\UserRoles;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/register-vendor', [WebsiteController::class, 'registerVendor']);

// Routes for users with 'admin' role
Route::prefix('admin')
    ->middleware([
        'auth',
        'role:'.UserRoles::ADMIN->value.'',
        config('jetstream.auth_session'),
        'verified'])
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        Route::get('/sliders', [SliderController::class, 'index']);
        Route::get('/sliders/{slider}/edit', [SliderController::class, 'edit']);
        Route::post('/sliders/{slider}/update', [SliderController::class, 'update']);
        Route::post('/sliders/save', [SliderController::class, 'save']);
        Route::get('/sliders/delete/{slider}', [SliderController::class, 'delete']);

        // Categories
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'getAllCategories'])->name('categoryList.list');
            Route::get('/sub-categories', [CategoryController::class, 'getAllSubCategories'])->name('categoryList.list');
            Route::get('/{category}', [CategoryController::class, 'getCategory']);
            Route::get('/{category}/sub-categories', [CategoryController::class, 'fetchSubCategory']);

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

        // Product Attribute
        Route::prefix('product-attribute')->group(function () {
            Route::get('/', [ProductAttributeController::class, 'getAllProductAttributes'])->name('productAttributes.list');
            Route::get('/{productAttribute}', [ProductAttributeController::class, 'getProductAttribute']);
            Route::post('/store', [ProductAttributeController::class, 'addProductAttribute']);
            Route::post('/update', [ProductAttributeController::class, 'updateProductAttribute'])->name('productAttributes.update');
        });

        // Product
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/{product}', [ProductController::class, 'edit']);
            Route::get('/{product}/gallery', [ProductController::class, 'getGallery']);
            Route::get('/gallery/{media}/delete', [ProductController::class, 'deleteGalleryImage']);
            Route::post('/{product}/gallery', [ProductController::class, 'saveProductGallery']);
            Route::post('/store', [ProductController::class, 'store']);
            Route::post('/update/{product}', [ProductController::class, 'update']);
            Route::post('/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
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
