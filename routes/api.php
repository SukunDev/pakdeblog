<?php

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Cviebrock\EloquentSluggable\Services\SlugService;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts/checkSlug', function (Request $request) {
    $slug = SlugService::createSlug(Posts::class, 'slug', $request->title);
    return response()->json(['slug' => $slug]);
});
