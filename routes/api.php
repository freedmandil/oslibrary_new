<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaxonomyController;
use App\Http\Controllers\LabelsController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
    Route::middleware('throttle:100,1')->group(function () {

        Route::controller(BookController::class)->group(function () {
            Route::match(['get', 'post'], '/books/{method}/{param?}', 'handle');
        });

        Route::controller(AuthorController::class)->group(function () {
            Route::match(['get', 'post'], '/authors/{method}/{param?}', 'handle');
        });

        Route::controller(LocationController::class)->group(function () {
            Route::match(['get', 'post'], '/locations/{method}/{param?}', 'handle');
        });

        Route::controller(TaxonomyController::class)->group(function () {
            Route::match(['get', 'post'], '/tax/{method}/{param?}', 'handle');
        });

        Route::controller(UserController::class)->group(function () {
            Route::match(['get', 'post'], '/users/{method}/{param?}', 'handle');
        });

        Route::controller(LabelsController::class)->group(function () {
            Route::match(['get', 'post'], '/labels/{method}/{param?}', 'handle');
        });

        Route::controller(SystemController::class)->group(function () {
            Route::match(['get', 'post'], '/system/{method}/{param?}', 'handle');
        });

        Route::controller(MessagesController::class)->group(function () {
            Route::match(['get', 'post'], '/messages/{method}/{param?}', 'handle');
        });

    });
