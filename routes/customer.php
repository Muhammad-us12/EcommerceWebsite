<?php

use App\Enums\UserRoles;
use App\Http\Controllers\CustomerController;
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
    });
