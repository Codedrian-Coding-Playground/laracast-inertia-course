<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::inertia('/', 'Home', ['users' => User::paginate(3)])->name('dashboard');
    Route::get('/profile', function () {
        return inertia('Profile', [
            'isActive' => 'profile',
        ]);
    })->name('profile');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::resource('users', UserController::class)->middleware([HandlePrecognitiveRequests::class]);
Route::inertia('/register', 'Auth/Register')->name('register');

Route::inertia('/login', 'Auth/Login')->name('login');
Route::post('/login', [UserController::class, 'login'])->middleware([HandlePrecognitiveRequests::class]);
