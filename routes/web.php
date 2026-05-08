<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['can:manage all users'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('classes',ClassroomController::class);
        Route::get('classes/{class}/students', [ClassRoomController::class, 'students'])->name('classes.students');
        Route::resource('teachers', TeacherController::class);
    });

    Route::middleware(['can:manage students'])->group(function () {
        Route::resource('students', StudentController::class);
    });
});

require __DIR__.'/auth.php';
