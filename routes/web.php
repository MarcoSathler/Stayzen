<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisteredUserController::class, 'index'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [RegisteredUserController::class, 'loginPage'])->name('login');
Route::post('/login', [RegisteredUserController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::resource('reservations', ReservationController::class);
    Route::get('/my-reservations', [ReservationController::class, 'myReservations'])->name('reservations.my');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
