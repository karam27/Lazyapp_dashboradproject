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

Route::apiResource('users', UserController::class);

Route::get('/eye-levels', [EyeLevelController::class, 'index']);

Route::get('/reports', [ReportController::class, 'index']);
Route::get('/reports/excel', [ReportController::class, 'exportToExcel']);

Route::get('/settings', [SettingsController::class, 'edit']);
Route::put('/settings', [SettingsController::class, 'update']);

Route::get('dashboard', [DashboardController::class, 'index']);


Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});



Route::middleware('auth:sanctum')->group(function () {

    // Dashboard


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // Users

    //Doctor

    // Eye Levels

    // Reports

    // Settings

});
