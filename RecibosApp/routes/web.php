<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [AuthController::class, 'indexRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('create.register');

Route::get('/login', [AuthController::class, 'indexAuht'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Ruta protegida (requiere autenticación)
Route::middleware('auth')->group(function () {
    Route::get('/dash', [UsuarioController::class, 'index'])->name('dash.index');
    Route::get('/recibos/{id}/pdf', [ReciboController::class, 'downloadPDF'])->name('recibos.pdf');
});

