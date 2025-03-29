<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\EmployeePanel;
use App\Http\Controllers\Dashboard\LeaveController;
use App\Http\Controllers\Auth\EmployeeLoginController;

Route::get('/', function () {
    return view('welcome');
})->middleware(['redirect.employee']);



Route::middleware('auth:employee')->group(function () {

    Route::get('employee-panel/user', [EmployeePanel::class, 'index'])->name('employee-panel.user');

    // بداية تكويد الأجازات
    Route::resource('/leaves', LeaveController::class);
    Route::post('leaves/leaves/balance', [LeaveController::class, 'getLeaveBalance'])->name('leaves.getLeavesBalances');
});


//------------------------ Login
Route::middleware('redirect.employee')->group(function () {
    Route::get('/login', [EmployeeLoginController::class, 'create'])->name('employees.login');
    Route::post('/login', [EmployeeLoginController::class, 'store']);
});


//------------------------ Logout
Route::middleware('auth:employee')->group(function () {
    Route::post('logout', [EmployeeLoginController::class, 'destroy'])
        ->name('employees.logout');
});


