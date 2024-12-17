<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TugasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::middleware('auth:api')->group(function () {
    Route::get('tasks', [TugasController::class, 'index']); // Filter tasks by status
    Route::post('tasks', [TugasController::class, 'store']);
    Route::put('tasks/{id}', [TugasController::class, 'update']);
    Route::delete('tasks/{id}', [TugasController::class, 'destroy']);
});
