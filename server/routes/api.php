<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RecordController;
use App\Models\User;

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::post('/register', [UserController::class, 'store'])->name('users.store');
Route::get('/users', [UserController::class, 'index'])->name('find');

Route::get('/doctors', function (Request $request) {
    $doctors = User::where('user_type', 'Doctor')->select('id', 'name')->get();
    return response()->json($doctors);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::delete('/delete/{id}', [UserController::class, 'destroy']);

    // Appointments
    Route::post('/appointments', [AppointmentController::class, 'store']);
    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::get('/appointments/{id}', [AppointmentController::class, 'show']);
    Route::put('/appointments/{id}', [AppointmentController::class, 'update']);
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy']);

    // Medical Records
    Route::get('/records', [RecordController::class, 'index']);
    Route::post('/records', [RecordController::class, 'store']);
    Route::get('/records/{id}', [RecordController::class, 'show']);
    Route::put('/records/{id}', [RecordController::class, 'update']);
    Route::delete('/records/{id}', [RecordController::class, 'destroy']);
});
