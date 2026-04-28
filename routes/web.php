<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HRController;

use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProvinceController;
/*
|--------------------------------------------------------------------------
| Login Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LoginController::class, 'loginPage'])->name('login');
Route::post('/login/action', [LoginController::class, 'login'])->name('login.action');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| HR Routes
|--------------------------------------------------------------------------
*/

Route::get('/hr/dashboard', [HRController::class, 'dashboard'])->name('hr.dashboard');

Route::get('/hr/employees', [HRController::class, 'employees'])->name('hr.employees');
Route::get('/hr/employee/create', [HRController::class, 'createEmployee'])->name('hr.employee.create');
Route::post('/hr/employee/store', [HRController::class, 'storeEmployee'])->name('hr.employee.store');
Route::get('/hr/employee/edit/{id}', [HRController::class, 'editEmployee'])->name('hr.employee.edit');
Route::post('/hr/employee/update/{id}', [HRController::class, 'updateEmployee'])->name('hr.employee.update');
Route::get('/hr/employee/delete/{id}', [HRController::class, 'deleteEmployee'])->name('hr.employee.delete');
Route::get('/hr/employee/show/{id}', [HRController::class, 'showEmployee'])->name('hr.employee.show');
Route::get('/hr/employee/search/api', [HRController::class, 'searchEmployees'])->name('hr.employee.search');

/*
|--------------------------------------------------------------------------
| Departments
|--------------------------------------------------------------------------
*/

Route::get('/hr/departments', [HRController::class, 'departments'])->name('hr.departments');
Route::post('/hr/departments/store', [HRController::class, 'storeDepartment'])->name('hr.departments.store');
Route::post('/hr/departments/update/{id}', [HRController::class, 'updateDepartment'])->name('hr.departments.update');
Route::get('/hr/departments/delete/{id}', [HRController::class, 'deleteDepartment'])->name('hr.departments.delete');

/*
|--------------------------------------------------------------------------
| Roles
|--------------------------------------------------------------------------
*/

Route::get('/hr/roles', [HRController::class, 'roles'])->name('hr.roles');
Route::post('/hr/roles/store', [HRController::class, 'storeRole'])->name('hr.roles.store');
Route::post('/hr/roles/update/{id}', [HRController::class, 'updateRole'])->name('hr.roles.update');
Route::get('/hr/roles/delete/{id}', [HRController::class, 'deleteRole'])->name('hr.roles.delete');

/*
|--------------------------------------------------------------------------
| Employee Status
|--------------------------------------------------------------------------
*/

Route::get('/hr/status', [HRController::class, 'status'])->name('hr.status');
Route::post('/hr/status/store', [HRController::class, 'storeStatus'])->name('hr.status.store');
Route::post('/hr/status/update/{id}', [HRController::class, 'updateStatus'])->name('hr.status.update');
Route::get('/hr/status/delete/{id}', [HRController::class, 'deleteStatus'])->name('hr.status.delete');

/*
|--------------------------------------------------------------------------
| Provinces & Stores k3
|-------------------------------------------------------------------------- */

// ============================
//  Stores Statistics
// ============================
Route::get('/stores/statistics', [StoreController::class, 'statistics'])->name('stores.statistics');

// ============================
//  Stores Management
// ============================
Route::resource('stores', StoreController::class);

// ============================
//  Provinces Management
// ============================
Route::resource('provinces', ProvinceController::class);

// ============================
//  Stores API
// ============================
Route::prefix('api')->group(function () {
    Route::get('/stores/search', [StoreController::class, 'apiSearch']);
    Route::get('/stores', [StoreController::class, 'apiIndex']);
    Route::post('/stores', [StoreController::class, 'apiStore']);
    Route::get('/stores/{id}', [StoreController::class, 'apiShow']);
    Route::put('/stores/{id}', [StoreController::class, 'apiUpdate']);
    Route::delete('/stores/{id}', [StoreController::class, 'apiDestroy']);
});
