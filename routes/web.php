<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaisController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\DeportesController;

// Página principal = login
Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIN
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// REGISTER
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// HOME
Route::get('/home', [HomeController::class, 'index'])->name('home');

// CRUDS
Route::resource('pais', PaisController::class);
Route::resource('disciplina', DisciplinaController::class);
Route::resource('deportista', DeportesController::class);
