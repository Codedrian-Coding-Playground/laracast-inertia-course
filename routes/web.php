<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [UserController::class, 'index']);
Route::get('/profile', function () {
    return Inertia::render('Profile');
})->name('profile');
