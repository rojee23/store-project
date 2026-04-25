<?php

use App\Http\Controllers\HRController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

    // Employees
    Route::get('/employees', [HRController::class, 'employees'])->name('hr.employees');
    Route::get('/employee/create', [HRController::class, 'createEmployee'])->name('hr.employee.create');
    Route::post('/employee/store', [HRController::class, 'storeEmployee'])->name('hr.employee.store');
    Route::get('/employee/edit/{id}', [HRController::class, 'editEmployee'])->name('hr.employee.edit');
    Route::post('/employee/update/{id}', [HRController::class, 'updateEmployee'])->name('hr.employee.update');
    Route::get('/employee/delete/{id}', [HRController::class, 'deleteEmployee'])->name('hr.employee.delete');
    Route::get('/employee/show/{id}', [HRController::class, 'showEmployee'])->name('hr.employee.show');
    Route::get('/employee/search/api', [HRController::class, 'searchEmployees'])->name('hr.employee.search.api');

    // Departments
    Route::get('/departments', [HRController::class, 'departments']);
    Route::post('/departments/store', [HRController::class, 'storeDepartment']);
    Route::post('/departments/update/{id}', [HRController::class, 'updateDepartment']);
    Route::get('/departments/delete/{id}', [HRController::class, 'deleteDepartment']);

    // Roles
    Route::get('/roles', [HRController::class, 'roles']);
    Route::post('/roles/store', [HRController::class, 'storeRole']);
    Route::post('/roles/update/{id}', [HRController::class, 'updateRole']);
    Route::get('/roles/delete/{id}', [HRController::class, 'deleteRole']);

    // Employee Status
    Route::get('/status', [HRController::class, 'status']);
    Route::post('/status/store', [HRController::class, 'storeStatus']);
    Route::post('/status/update/{id}', [HRController::class, 'updateStatus']);
    Route::get('/status/delete/{id}', [HRController::class, 'deleteStatus']);

});

// ============================
//        TEST DB CONNECTION
// ============================
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();

        return 'Connected to SQL Server Successfully!';
    } catch (Exception $e) {
        return $e->getMessage();
    }
});
