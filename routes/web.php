<?php

use App\Enums\UserRoles;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerPaymentRequestController;
use App\Http\Controllers\ExtraPricesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductAttributeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorPercentageController;
use App\Http\Controllers\VendorSalePercentageController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Now make a checkout page for  take customer information about order  and create a  order save order details in order model and order lline items and customer information in seperate model and also wirte test for

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/product-details/{product}', [WebsiteController::class, 'productDetails']);
Route::get('/register-vendor', [WebsiteController::class, 'registerVendor']);

Route::post('/add-to-cart/{product}', [CartController::class, 'addToCart']);
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/order-confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

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
            Route::get('categories/{category}/edit-sub-category', [CategoryController::class, 'editSubCategory'])->name('categories.editSubCategory');
            Route::post('categories/{category}/edit-sub-category', [CategoryController::class, 'updateSubCategory'])->name('categories.update');
            Route::post('categories/{category}/delete', [CategoryController::class, 'deleteCategory'])->name('category.destroy');

            Route::post('/store', [CategoryController::class, 'addCategory']);
            Route::post('/update', [CategoryController::class, 'updateCategory'])->name('category.update');
        });

        // Locations
        Route::prefix('location')->group(function () {
            Route::get('/', [LocationController::class, 'locationList'])->name('location.list');
            Route::get('/{id}', [LocationController::class, 'getLocation']);
            Route::post('/store', [LocationController::class, 'addLocation']);
            Route::post('/update', [LocationController::class, 'updateLocation'])->name('location.update');
            Route::get('/delete-check/{id}', [LocationController::class, 'deleteCheck']);
            Route::post('/delete/{id}', [LocationController::class, 'destroyLocation'])->name('location.destroy');

        });

        // Locations
        Route::prefix('vendor-percentage')->group(function () {
            Route::get('/', [VendorPercentageController::class, 'index']);
            Route::get('/{id}', [VendorPercentageController::class, 'getPercentage']);
            Route::post('/store', [VendorPercentageController::class, 'store']);
            Route::post('/update', [VendorPercentageController::class, 'update']);
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

        // Extra Prices
        Route::prefix('extra-price')->group(function () {
            Route::get('/', [ExtraPricesController::class, 'getAllExtraPrices'])->name('extraPrices.list');
            Route::get('/{extraPrice}', [ExtraPricesController::class, 'getExtraPrices']);
            Route::post('/store', [ExtraPricesController::class, 'addExtraPrices']);
            Route::post('/update', [ExtraPricesController::class, 'updateExtraPrices'])->name('extraPrices.update');
        });

        // Product
        Route::prefix('product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/{product}', [ProductController::class, 'edit']);
            Route::get('/{product}/gallery', [ProductController::class, 'getGallery']);
            Route::get('/gallery/{media}/delete', [ProductController::class, 'deleteGalleryImage']);
            Route::post('/{product}/gallery', [ProductController::class, 'saveProductGallery']);
            Route::post('/store', [ProductController::class, 'store']);
            Route::post('/update/{product}', [ProductController::class, 'update'])->name('product.update');
            Route::post('/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
        });

        // Orders
        Route::prefix('orders')->group(function () {
            Route::get('/', [OrderController::class, 'index']);
            Route::get('/{order}', [OrderController::class, 'show']);
            Route::post('/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        });

        // Customer
        Route::prefix('customer')->group(function () {
            Route::get('/', [CustomerController::class, 'allCustomersList']);
        });

        Route::prefix('vendor')->group(function () {
            Route::get('/', [VendorController::class, 'allVendorsList']);
        });

        Route::prefix('customer-payment-requests')->group(function () {
            Route::get('/', [CustomerPaymentRequestController::class, 'allPaymentRequestsList']);
            Route::post('/update-payment-status', [CustomerPaymentRequestController::class, 'update_payment_status']);
        });

        Route::resource('vendorSalePercentages', VendorSalePercentageController::class);

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
include_once 'accounts.php';
