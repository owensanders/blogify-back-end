<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('posts')->group(function () {
    Route::get('/user/{id}', [PostController::class, 'index'])->name('posts.user');
    Route::post('/create', [PostController::class, 'store'])->name('posts.store');
    Route::put('/update', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});
