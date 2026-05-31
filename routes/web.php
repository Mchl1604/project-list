<?php

use App\Http\Controllers\SignInController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Guest routes (not logged in)
Route::middleware('guest')->group(function () {
    Route::get('/', [SignInController::class, 'loginindex'])->name('login.index');
    Route::get('/signIn', [SignInController::class, 'registerindex'])->name('register.index');
    Route::post('/register', [SignInController::class, 'registerUser'])->name('register.store');
    Route::post('/signIn', [SignInController::class, 'loginUser'])->name('login.main');
});

Route::post('/logout', [SignInController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard.index');
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.delete');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/picture', [ProfileController::class, 'updateProfilePicture'])->name('profile.picture.update');
    Route::post('/profile/information', [ProfileController::class, 'updateProfileInformation'])->name('profile.information.update');

});