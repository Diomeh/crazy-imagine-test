<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function() {
    return Inertia::render('Index');
});

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

Route::post('/logout', [UserController::class, 'logout']);

Route::resource('students', StudentController::class);
