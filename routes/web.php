<?php

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return inertia('Profile', [
            'isActive' => 'profile',
        ]);
    })->name('profile');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::get('/', [UserController::class, 'index'])->name('dashboard');

Route::resource('users', UserController::class)->middleware([HandlePrecognitiveRequests::class]);
Route::inertia('/register', 'Auth/Register')->name('register');

Route::inertia('/login', 'Auth/Login')->name('login');
Route::post('/login', [UserController::class, 'login'])->middleware([HandlePrecognitiveRequests::class]);
