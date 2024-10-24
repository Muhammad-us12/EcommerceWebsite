<?php

use App\Enums\UserRoles;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

// Routes for users with 'user' role
Route::prefix('teacher')
    ->middleware([
        'auth',
        'role:'.UserRoles::TEACHER.'',
        config('jetstream.auth_session'),
        'verified'])
    ->group(function () {

        Route::get('/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    });
