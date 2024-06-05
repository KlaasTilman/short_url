<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\TokenController;
use Illuminate\Support\Facades\Route;

// Route for the login
Route::get('/', function () {
    return view('auth.login');
});

// Route for the dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route for the urls
Route::resource('urls', UrlController::class)->middleware(['auth', 'verified']);

Route::resource('token', TokenController::class)->middleware(['auth', 'verified']);

// Route for the the short url redirecter
Route::get('/short_url/{short_url}', [UrlController::class, 'shortUrlRedirecter'])->name('short-url');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
