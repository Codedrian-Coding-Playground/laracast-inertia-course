<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $profileUrl = route('profile');
        return Inertia::render('Home', ['profileUrl' => $profileUrl]);
    }
}
