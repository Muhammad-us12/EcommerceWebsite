<?php

use App\Enums\UserRoles;
use App\Http\Controllers\VendorController;
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
    });
