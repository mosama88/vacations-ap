<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Dashboard\BranchController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\JobGradeController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LeaveBalanceController;
use App\Http\Controllers\Dashboard\FinanceCalendarController;


Route::middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    //--------------------------------------- Finance Calendars


    // بداية تكويد السنوات المالية
    Route::resource('/financeCalendars', FinanceCalendarController::class);
    Route::controller(FinanceCalendarController::class)->name('financeCalendars.')->prefix('financeCalendars')->group(function () {
        Route::get('open/{id}', 'open')->name('open');
        Route::get('close/{id}', 'close')->name('close');
    });


    // بداية تكويد الفروع
    Route::resource('/branches', BranchController::class);

    // بداية تكويد الدرجات الوظيفية
    Route::resource('/jobGrades', JobGradeController::class);

    // بداية تكويد الموظف
    Route::resource('/employees', EmployeeController::class);

    // بداية رصيد الأجازات
    Route::resource('/leaveBalances', LeaveBalanceController::class);
});


//------------------------ Login
Route::middleware('guest:admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'create'])
        ->name('login');

    Route::post('login', [AdminLoginController::class, 'store']);
});


//------------------------ Logout
Route::middleware('auth:admin')->group(function () {
    Route::post('logout', [AdminLoginController::class, 'destroy'])
        ->name('logout');
});





// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });