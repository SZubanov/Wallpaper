<?php

declare(strict_types=1);

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Test\ApiTestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WallpaperController;
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

Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('wallpapers', WallpaperController::class)->except(['show']);
    Route::get('wallpapers/create/many', [WallpaperController::class, 'createMany'])->name('wallpapers.create-many');
    Route::post('wallpapers/store/many', [WallpaperController::class, 'storeMany'])->name('wallpapers.store-many');

});
