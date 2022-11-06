<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;

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

Route::prefix('auth')->group(function () {
    Route::get('/signin', [AuthController::class, 'index'])
        ->middleware('guest')
        ->name('login');
    Route::post('/signin', [AuthController::class, 'loginPost']);
});
Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
    });

Route::get('/', [BlogController::class, 'index']);
Route::get('/{name}/{value}', [BlogController::class, 'filterIndex']);
Route::get('/{post:slug}', [BlogController::class, 'singlePost']);
