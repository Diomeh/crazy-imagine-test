<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Singup routes
Route::get('/signup', function() {
    return Inertia::render('Signup');
})->name('signup');
Route::post('/signup', [UserController::class, 'registerUser']);
