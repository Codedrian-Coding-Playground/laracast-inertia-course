<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;

Route::get('/', function () {
    sleep(1);
    return inertia('Home', [
        'isActive' => 'dashboard'
    ]);
})->name('dashboard');
Route::get('/profile', function () {
    return inertia('Profile', [
        'isActive' => 'profile'
    ]);
})->name('profile');
Route::inertia('/register', 'Auth/Register');
Route::post('/register', [UserController::class, 'create'])->middleware([HandlePrecognitiveRequests::class]);;
