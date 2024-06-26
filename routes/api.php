<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Http\Controllers\MailSender;
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


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/get_users', [UserController::class, 'index'])->name('users.get');
    Route::post('/validate', [UserController::class, 'validate_user'])->name('users.validate');
    Route::post('/post_users', [UserController::class, 'store'])->name('users.post');
    Route::get('/search_users/{key}/{value}', [UserController::class, 'search'])->name('users.search');

    Route::post('/sendMail', [MailSender::class, 'sendMail']);
});

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/verify', [AuthController::class, 'verifyOtp'])->name('auth.verify');

// Route::get('/get_users', [UserController::class, 'index'])->name('users.get');
// Route::post('/post_users', [UserController::class, 'store'])->name('users.post');
// Route::get('/search_users/{key}/{value}', [UserController::class, 'search'])->name('users.search');
// Route::get('/sendMail', [MailSender::class, 'sendMail']);
