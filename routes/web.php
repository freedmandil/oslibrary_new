<?php
require __DIR__.'/auth.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;

use App\Models\SysColor;
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


Route::get('colors.css', function () {
    $colors = SysColor::all();

    return response()->view('colors', compact('colors'))
        ->header('Content-Type', 'text/css');
});

Route::get('/', function () {
    return view('home');
});
Route::get('/home', function () {
    return view('home');
});
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/search', [SearchController::class, 'index'])->name('search');
// Route to show registration form
Route::middleware(['web', 'restrictByIP'])->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.show');
// Route to handle registration form submission
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::resource('users', UserController::class);
});

Route::middleware(['web', 'auth', 'restrictByIP'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



