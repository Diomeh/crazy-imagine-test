<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Singup routes
Route::get('/singup', [UserController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [UserController::class, 'registerUser'])->name('signup.submit');
