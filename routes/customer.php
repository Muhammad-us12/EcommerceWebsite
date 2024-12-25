<?php

use App\Enums\UserRoles;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\CustomerPaymentRequestController;
use Illuminate\Support\Facades\Route;

// Routes for users with 'user' role
Route::prefix('customer')
    ->middleware([
        'auth',
        'role:'.UserRoles::CUSTOMER->value.'',
        config('jetstream.auth_session'),
        'verified'])
    ->group(function () {

        Route::get('/dashboard', [CustomerController::class, 'index'])->name('customer.dashboard');

        Route::get('/payment_request', [CustomerPaymentRequestController::class, 'paymentRequests']);
        Route::post('/payment_request_submit', [CustomerPaymentRequestController::class, 'store']);

        Route::get('/order-list', [CustomerOrderController::class, 'index']);
        Route::get('/orders/{order}', [CustomerOrderController::class, 'show']);

    });
