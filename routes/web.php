<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\LeaveController;
use App\Http\Controllers\Auth\EmployeeLoginController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/employee-panel', function () {
    return view('front.index');
})->name('employee-panel')->middleware('auth:employee');

Route::middleware('auth:employee')->group(function () {
    // بداية تكويد الأجازات
    Route::resource('/leaves', LeaveController::class);
    Route::post('leaves/leaves/balance', [LeaveController::class, 'getLeaveBalance'])->name('leaves.getLeavesBalances');
});
if (redirect('/')) {
    //------------------------ Login
    Route::middleware('guest:employee')->group(function () {

        Route::get('/', [EmployeeLoginController::class, 'create'])->name('employees.login');


        Route::post('/', [EmployeeLoginController::class, 'store']);
    });
}

//------------------------ Logout
Route::middleware('auth:employee')->group(function () {
    Route::post('logout', [EmployeeLoginController::class, 'destroy'])
        ->name('employees.logout');
});