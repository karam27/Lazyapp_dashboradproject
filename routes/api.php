<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\EyeLevelController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\ProfileController;
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


Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});



Route::middleware('auth:sanctum')->group(function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('api.dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('api.profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('api.profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('api.profile.destroy');
    // Users

    //Doctor

    // Eye Levels

    // Reports
    Route::get('/reports', [ReportController::class, 'index']);
    Route::get('/reports/excel', [ReportController::class, 'exportToExcel']);

    // Settings
    Route::get('/settings', [SettingsController::class, 'edit']);
    Route::put('/settings', [SettingsController::class, 'update']);
});
