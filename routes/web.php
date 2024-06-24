<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/profile', function () {
    return inertia('Profile');
});
