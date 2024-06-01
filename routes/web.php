<?php

use Illuminate\Support\Facades\Route;
// use App\Mail\Usermail;
// use Illuminate\Support\Facades\Mail;

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

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/verify', function () {
    return view('auth.otpVerify');
})->name('verify_otp');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('admin.adminDashboard');
})->name('admin.dashboard');

Route::get('/profile', function () {
    return view('admin.adminProfile');
})->name('admin.profile');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin.adminDashboard');
//     })->name('admin.dashboard');
// });


// Route::get('/sendMail/{username}/{email}/{password}', function () {

//     Mail::to('dvoid367@gmail.com')->send(new Usermail());
// });
