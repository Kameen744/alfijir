<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('posts', 'App\Http\Controllers\Api\ApiController@posts');
    Route::get('posts/{news}', 'App\Http\Controllers\Api\ApiController@read');
    Route::get('category', 'App\Http\Controllers\Api\ApiController@category');
    Route::get('category/{category}', 'App\Http\Controllers\Api\ApiController@post_category');
});
