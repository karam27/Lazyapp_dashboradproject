<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\EyeLevelController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\SettingsController;
use App\Http\Controllers\API\UserController;
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

Route::apiResource('doctors', DoctorController::class);



Route::apiResource('/eye-levels', EyeLevelController::class);

Route::apiResource('/reports', ReportController::class);

Route::get('/reports/excel', [ReportController::class, 'exportToExcel']);

Route::get('/settings', [SettingsController::class, 'edit']);
Route::put('/settings', [SettingsController::class, 'update']);

// Route::get('dashboard', [DashboardController::class, 'index']);




Route::middleware('guest')->group(function () {});


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register']);

    // Dashboard


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // Users
    Route::apiResource('users', UserController::class);
    //Doctor

    // Eye Levels

    // Reports

    // Settings

});
