<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NonAPI\CategoryController;
use App\Http\Controllers\NonAPI\DashboardController;
use App\Http\Controllers\NonAPI\ProductController;
use App\Http\Controllers\NonAPI\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Guest Session
Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/', 'login')->name('login');
        Route::get('register', 'register')->name('register');
        Route::post('register', 'registerProcess')->name('register.process');
        Route::post('/', 'loginProcess')->name('login.process');
    });
});

// Auth Session
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::controller(UserController::class)->group(function () {
        Route::get('users', 'index')->name('users.data');
        Route::get('users/{user}', 'edit')->name('users.edit');
        Route::post('users/{user}', 'update')->name('users.update');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('user.logout');
});
