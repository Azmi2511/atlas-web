<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\ProfileController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::put('/profile', [ProfileController::class, 'update']);

    // Attendance dengan middleware GPS (opsional, bisa diaktifkan jika ingin wajib GPS)
    Route::post('/attendance', [AttendanceController::class, 'submit']);
    Route::get('/attendance/history', [AttendanceController::class, 'history']);

    // Endpoint untuk mendapatkan QR token (jika diperlukan mobile untuk scan)
    // Route::get('/qr/token', [QRController::class, 'generateToken']);
});