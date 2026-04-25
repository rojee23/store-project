<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HRController;

// ============================
//        LOGIN ROUTES
// ============================
Route::get('/', [LoginController::class, 'loginPage'])->name('login');
Route::post('/login', [LoginController::class, 'loginAction'])->name('login.action');

// ============================
//        HR ROUTES
// ============================
Route::prefix('hr')->group(function () {

    // Dashboard
    Route::get('/dashboard', [HRController::class, 'dashboard'])->name('hr.dashboard');

    // Employees List
    Route::get('/employees', [HRController::class, 'employees'])->name('hr.employees');

    // Create Employee
    Route::get('/employee/create', [HRController::class, 'createEmployee'])->name('hr.employee.create');
    Route::post('/employee/store', [HRController::class, 'storeEmployee'])->name('hr.employee.store');

    // Edit Employee
    Route::get('/employee/edit/{id}', [HRController::class, 'editEmployee'])->name('hr.employee.edit');
    Route::post('/employee/update/{id}', [HRController::class, 'updateEmployee'])->name('hr.employee.update');

    // Delete Employee
    Route::get('/employee/delete/{id}', [HRController::class, 'deleteEmployee'])->name('hr.employee.delete');

    // Show Employee Details
    Route::get('/employee/show/{id}', [HRController::class, 'showEmployee'])->name('hr.employee.show');

    // AJAX Search API
    Route::get('/employee/search/api', [HRController::class, 'searchEmployees'])->name('hr.employee.search.api');
});

// ============================
//        TEST DB CONNECTION
// ============================
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Connected to SQL Server Successfully!";
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
