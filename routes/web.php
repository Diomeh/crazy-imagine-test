<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return view('welcome');
});

// Singup routes
Route::get('/signup', function() {
    return Inertia::render('Signup');
});
Route::post('/signup', [UserController::class, 'registerUser']);
