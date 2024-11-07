<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Show the registration form
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');

// Handle the registration form submission
Route::post('/register', [UserController::class, 'register']);

// Show the login form
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

// Handle the login form submission
Route::post('/login', [UserController::class, 'login']);

// Logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// Show the
Route::middleware(['auth'])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    });
});

Route::get('/app', function () {
    return view('appDir.app'); // Adjust the path to match the location of your view
})->name('appDir.app');
