<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorsController;
use App\Http\Controllers\TvController;

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
    return redirect()->route('movie.index');
})->name('home');

Route::group(['prefix' => 'search'], function () {
    Route::get('/{search}', SiteController::class)->name('site.index');
    Route::get('/{search}/{page?}', SiteController::class)->name('site.index.page');
});
Route::group(['prefix' => '/movies'], function () {
    Route::get('/', [MovieController::class, 'index'])->name('movie.index');
    Route::get('/{movie}/search', [MovieController::class, 'search'])->name('movie.search');
    Route::get('/{movie}', [MovieController::class, 'show'])->name('movie.show');
});

Route::group(['prefix' => '/tv'], function () {
    Route::get('/', [TvController::class, 'index'])->name('tv.index');
    Route::get('/{tv}', [TvController::class, 'show'])->name('tv.show');
});

Route::group(['prefix' => '/actors'], function () {
    Route::get('/', [ActorsController::class, 'index'])->name('actors.index');
    Route::get('/page/{page?}', [ActorsController::class, 'index'])->name('actors.index.page');
    Route::get('/{actor}', [ActorsController::class, 'show'])->name('actors.show');
});
