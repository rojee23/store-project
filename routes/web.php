<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;   // ← أضف هذا السطر

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HRController;

Route::get('/', [LoginController::class, 'loginPage'])->name('login');
Route::post('/login', [LoginController::class, 'loginAction'])->name('login.action');

Route::get('/hr/dashboard', [HRController::class, 'dashboard'])->name('hr.dashboard');
Route::get('/hr/employee/create', [HRController::class, 'createEmployee'])->name('hr.employee.create');
Route::post('/hr/employee/store', [HRController::class, 'storeEmployee'])->name('hr.employee.store');

// Test DB Route
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();   // ← بدون backslash
        return "Connected to SQL Server Successfully!";
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
