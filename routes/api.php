<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UrlController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/urls', [UrlController::class, 'index'])->middleware(['auth:sanctum']);
Route::post('/urls', [UrlController::class, 'store'])->middleware(['auth:sanctum']);
Route::put('/urls/{url}', [UrlController::class, 'update'])->middleware(['auth:sanctum']);
Route::delete('/urls/{url}', [UrlController::class, 'destroy'])->middleware(['auth:sanctum']);