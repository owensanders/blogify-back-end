<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::post('/my-profile/update', [UserController::class, 'update'])->middleware('auth')->name('my.profile.update');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/posts.php';
