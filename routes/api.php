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

// Routes related to books
Route::get('/books/{method}/{param?}', [BookController::class, 'handle']);
Route::post('/books/{method}/{param?}', [BookController::class, 'handle']);
Route::post('/titles/{method}/{param?}', [BookController::class, 'handle']);
Route::post('/publishers/{method}/{param?}', [BookController::class, 'handle']);
Route::get('/titles/{method}/{param?}', [BookController::class, 'handle']);
Route::get('/publishers/{method}/{param?}', [BookController::class, 'handle']);

// Routes related to authors
Route::post('/authors/{method}/{param?}', [AuthorController::class, 'handle']);
Route::get('/authors/{method}/{param?}', [AuthorController::class, 'handle']);

// Routes related to locations
Route::post('/shelf/{method}/{param?}', [LocationController::class, 'handle']);
Route::post('/locations/{method}/{param?}', [LocationController::class, 'handle']);
Route::post('/assigns/{method}/{param?}', [LocationController::class, 'handle']);
Route::get('/shelf/{method}/{param?}', [LocationController::class, 'handle']);
Route::get('/locations/{method}/{param?}', [LocationController::class, 'handle']);
Route::get('/assigns/{method}/{param?}', [LocationController::class, 'handle']);

// Routes related to taxonomy
Route::post('/topics/{method}/{param?}', [TaxonomyController::class, 'handle']);
Route::post('/groups/{method}/{param?}', [TaxonomyController::class, 'handle']);
Route::post('/categories/{method}/{param?}', [TaxonomyController::class, 'handle']);
Route::post('/subcats/{method}/{param?}', [TaxonomyController::class, 'handle']);
Route::get('/topics/{method}/{param?}', [TaxonomyController::class, 'handle']);
Route::get('/groups/{method}/{param?}', [TaxonomyController::class, 'handle']);
Route::get('/categories/{method}/{param?}', [TaxonomyController::class, 'handle']);
Route::get('/subcats/{method}/{param?}', [TaxonomyController::class, 'handle']);

// Routes related to users
Route::post('/users/{method}/{param?}', [UserController::class, 'handle']);
Route::get('/users/{method}/{param?}', [UserController::class, 'handle']);

// Routes related to labels
Route::post('/labels/{method}/{param?}', [LabelsController::class, 'handle']);
Route::get('/labels/{method}/{param?}', [LabelsController::class, 'handle']);

// Routes related to system
Route::get('/system/{method}/{param?}', [SystemController::class, 'handle']);
Route::post('/system/{method}/{param?}', [SystemController::class, 'handle']);

// Routes related to messaging
Route::post('/messages/{method}/{param?}', [MessagesController::class, 'handle']);
Route::get('/messages/{method}/{param?}', [MessagesController::class, 'handle']);
