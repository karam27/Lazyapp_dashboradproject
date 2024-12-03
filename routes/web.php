<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\EyeLevelController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', UserController::class);
Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('admin/settings', [SettingsController::class, 'edit'])->name('admin.settings');
Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');
Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
Route::resource('doctors', DoctorController::class);
Route::get('admin/doctors', [DoctorController::class, 'index'])->name('admin.doctors');
Route::get('admin/eye-levels', [EyeLevelController::class, 'index'])->name('admin.eye_levels');
Route::get('/report', [ReportController::class, 'index'])->name('reports.admin');
Route::get('/reports/excel', [ReportController::class, 'exportToExcel'])->name('reports.excel');


require __DIR__ . '/auth.php';
