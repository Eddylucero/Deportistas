<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\DeportesController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('paises', PaisController::class);
    Route::resource('disciplinas', DisciplinaController::class);
    Route::resource('deportistas', DeportesController::class);
});


Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetCode'])
    ->name('password.email');

Route::get('/verify-code', [ResetPasswordController::class, 'showVerifyForm'])
    ->name('password.verify');

Route::post('/verify-code', [ResetPasswordController::class, 'verifyCode'])
    ->name('password.verify.post');

Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset.form');

Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])
    ->name('password.update');

