<?php

use App\Enums\UserRoles;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Routes for users with 'user' role
Route::prefix('student')
    ->middleware([
        'auth',
        'role:'.UserRoles::STUDENT.'',
        config('jetstream.auth_session'),
        'verified'])
    ->group(function () {

        Route::get('/dashboard', [StudentController::class, 'index'])->name('student.dashboard');
    });
