<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\EmployeeLoginController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/employee-panel', function () {
    return view('front.index');
})->name('employee-panel')->middleware('auth:employee');



//------------------------ Login
Route::middleware('guest:employee')->group(function () {
    Route::get('login', [EmployeeLoginController::class, 'create'])
        ->name('employees.login');

    Route::post('login', [EmployeeLoginController::class, 'store']);
});


//------------------------ Logout
Route::middleware('auth:employee')->group(function () {
    Route::post('logout', [EmployeeLoginController::class, 'destroy'])
        ->name('employees.logout');
});
