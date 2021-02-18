<?php

declare(strict_types=1);

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\WallpaperController;
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

Route::group(['prefix' => 'v1'], function () {
//    Route::group(['middleware' => 'auth_token'], function () {
        Route::get('wallpapers', [WallpaperController::class, 'getByCategory']);
        Route::get('wallpapers/{wallpaper}', [WallpaperController::class, 'show']);
        Route::get('wallpapers/download/{wallpaper}', [WallpaperController::class, 'download']);
        Route::get('search/wallpapers', [WallpaperController::class, 'search']);
        Route::get('categories', [CategoryController::class, 'index']);
        Route::get('categories/{category}', [CategoryController::class, 'show']);
//    });
});
