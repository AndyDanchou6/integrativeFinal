<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('/get_users', [UserController::class, 'index'])->name('users.get');
    Route::post('/post_users', [UserController::class, 'store'])->name('users.post');
    Route::get('/search_users/{key}/{value}', [UserController::class, 'search'])->name('users.search');
});

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::post('/validate', [AuthController::class, 'validate_user'])->name('api.validate');

// Route::get('/get_users', [UserController::class, 'index'])->name('users.get');
// Route::post('/post_users', [UserController::class, 'store'])->name('users.post');
// Route::get('/search_users/{key}/{value}', [UserController::class, 'search'])->name('users.search');
