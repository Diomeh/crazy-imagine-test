<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Signup routes
Route::get('/signup', function() {
    return Inertia::render('Signup');
});
Route::post('/signup', [UserController::class, 'registerUser']);

// Signin routes
Route::get('/signin', function() {
    return Inertia::render('Signin');
});
Route::post('/signin', [UserController::class, 'authUser']);

Route::get('/dashboard', [UserController::class, 'visitDashboard']);
