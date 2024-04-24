<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\CategoryAPIController;
use App\Http\Controllers\API\ProductAPIController;
use App\Http\Controllers\API\UserAPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Guest
Route::controller(AuthAPIController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

// API
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('categories', CategoryAPIController::class);
    Route::resource('products', ProductAPIController::class);
    Route::resource('users', UserAPIController::class);
    Route::post('logout', [AuthAPIController::class, 'logout']);
});
