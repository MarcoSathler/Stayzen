<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\AvailabilityController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\ServiceController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::middleware('throttle:5,1')->post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me', fn() => auth()->user());
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::get('services', [ServiceController::class, 'index']);
Route::get('services/{id}', [ServiceController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    // Users (admin)
    Route::middleware('can:manage-users')->group(function () {
        Route::get('users', [UserController::class, 'index']);
        Route::get('users/{id}', [UserController::class, 'show']);
        Route::patch('users/{id}', [UserController::class, 'update']);
        Route::delete('users/{id}', [UserController::class, 'destroy']);
    });

    // Reservations
    Route::get('reservations', [ReservationController::class, 'index']);
    Route::post('reservations', [ReservationController::class, 'store']);
    Route::get('reservations/{id}', [ReservationController::class, 'show']);
    Route::patch('reservations/{id}', [ReservationController::class, 'update']);
    Route::delete('reservations/{id}', [ReservationController::class, 'destroy']);

    Route::middleware('can:manage-services')->group(function () {
        Route::post('services', [ServiceController::class, 'store']);
        Route::patch('services/{id}', [ServiceController::class, 'update']);
        Route::delete('services/{id}', [ServiceController::class, 'destroy']);
    });
}
);
