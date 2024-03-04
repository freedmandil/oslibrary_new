<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\AuthorController;
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
Route::middleware(['auth.api'])->group(function () {
    // Routes that require authentication
    Route::get('/books/ByShelfname/{shelfName}', [BookController::class, 'booksByShelfName'])->name('books.byShelfName');
    Route::get('/books/ByID/{id}', [BookController::class, 'bookByID'])->name('books.byID');
    Route::get('/books/{method}/{param?}', [BookController::class, 'handle']);
    Route::post('/books/{method}/{param?}', [BookController::class, 'handle']);
    Route::get('/system/{method}/{param?}', [SystemController::class, 'handle']);

});
Route::post('/messages/{method}/{param?}', [MessagesController::class, 'handle']);
Route::get('/messages/{method}/{param?}', [MessagesController::class, 'handle']);
