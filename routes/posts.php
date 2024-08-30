<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('posts')->group(function () {
    Route::get('', [PostController::class, 'feed'])->name('posts.feed');
    Route::get('/user/{id}', [PostController::class, 'index'])->name('posts.user');
    Route::post('/create', [PostController::class, 'store'])->name('posts.store');
    Route::get('/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::put('/update', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/{id}/like', [PostController::class, 'like'])->name('posts.like');
});
