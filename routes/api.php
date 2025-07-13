<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Login (Tugas 1) — hanya bisa diakses TANPA token
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

// Middleware: auth:sanctum untuk endpoint yang butuh token (Tugas 2–7)
Route::middleware('auth:sanctum')->group(function () {

    // Logout (Tugas 7)
    Route::post('/logout', [AuthController::class, 'logout']);

    // Get All Divisions (Tugas 2)
    Route::get('/divisions', [DivisionController::class, 'index']);

    // Employee API (Tugas 3–6)
    Route::get('/employees', [EmployeeController::class, 'index']);        // Get all
    Route::post('/employees', [EmployeeController::class, 'store']);       // Create
    Route::put('/employees/{id}', [EmployeeController::class, 'update']);  // Update
    Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']); // Delete
});
