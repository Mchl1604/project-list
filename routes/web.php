<?php

use App\Http\Controllers\SignInController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SignInController::class, 'loginindex'])->name('login.index');  
Route::get('/signIn', [SignInController::class, 'registerindex'])->name('register.index');
Route::post('/register', [SignInController::class, 'registerUser'])->name('register.store');
Route::post('/signIn', [SignInController::class, 'loginUser'])->name('login.main');

Route::post('/logout', [SignInController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('Pages.dashboard');
});

Route::get('/projects', function () {
    return view('Pages.projects');
});

Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');