<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\Admin\Pages\PagesController;
use App\Http\Controllers\Admin\Posts\PostsController;
use App\Http\Controllers\Admin\Posts\Tags\TagsController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Posts\Categories\CategoriesController;

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
    Route::post('/logout', [AuthController::class, 'logout']);
});
Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::prefix('posts')->group(function () {
            Route::get('/', [PostsController::class, 'index']);
            Route::get('/new', [PostsController::class, 'createIndex']);
            Route::post('/new', [PostsController::class, 'insertPost']);
            Route::get('/edit/{post:slug}', [
                PostsController::class,
                'editIndex',
            ]);
            Route::post('/edit/{post:slug}', [
                PostsController::class,
                'changePost',
            ]);
            Route::get('/category', [CategoriesController::class, 'index']);
            Route::post('/category', [
                CategoriesController::class,
                'createCategory',
            ]);
            Route::get('/category/{id}/delete', [
                CategoriesController::class,
                'deleteCategory',
            ]);
            Route::get('/tags', [TagsController::class, 'index']);
            Route::post('/tags', [TagsController::class, 'createTags']);
            Route::get('/tags/{id}/delete', [
                TagsController::class,
                'deleteTags',
            ]);
            Route::get('/view/{post:slug}', [
                PostsController::class,
                'viewIndex',
            ]);
            Route::get('/delete/{id}', [PostsController::class, 'deletePost']);
        });
        Route::prefix('pages')->group(function () {
            Route::get('/', [PagesController::class, 'index']);
            Route::get('/new', [PagesController::class, 'createIndex']);
            Route::post('/new', [PagesController::class, 'addPages']);
            Route::get('/edit/{page:slug}', [
                PagesController::class,
                'editIndex',
            ]);
            Route::post('/edit/{page:slug}', [
                PagesController::class,
                'changePages',
            ]);
            Route::get('/view/{page:slug}', [
                PagesController::class,
                'viewIndex',
            ]);
            Route::get('/delete/{id}', [PagesController::class, 'deletePages']);
        });
        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingsController::class, 'index']);
            Route::post('/', [SettingsController::class, 'changeSiteInfo']);
            Route::get('/menu', [SettingsController::class, 'menuIndex']);
            Route::post('/menu', [SettingsController::class, 'changeMenu']);
        });
        Route::group(
            [
                'prefix' => 'laravel-filemanager',
                'middleware' => ['web', 'auth'],
            ],
            function () {
                \UniSharp\LaravelFilemanager\Lfm::routes();
            }
        );
    });

Route::get('/', [BlogController::class, 'index']);
Route::get('/contact', [BlogController::class, 'contactIndex']);
Route::get('/p/{page:slug}', [BlogController::class, 'singlePages']);
Route::get('/{post:slug}', [BlogController::class, 'singlePost']);
Route::get('/{name}/{value}', [BlogController::class, 'filterIndex']);
