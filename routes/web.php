<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppController;


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

// This route should NOT be inside the auth middleware, so we can visit it without being logged in
Route::get('/welcome', function () {
return view('welcome');
});

// Protected routes, requiring authentication
Route::middleware(['auth'])->group(function () {
    // Dashboard index route
    Route::get('/dashboard', [AppController::class, 'index'])->name('app.index');

    // Store a new win (POST request)
    Route::post('/dashboard/win', [AppController::class, 'storeWin'])->name('app.storeWin');
});

Route::get('/', [AppController::class, 'index'])->name('home');
Route::get('/app', [AppController::class, 'index'])->name('app.index');  // For the app (e.g., dashboard page)

