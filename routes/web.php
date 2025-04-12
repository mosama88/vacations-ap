<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;

use App\Http\Controllers\Front\EmployeePanel;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Dashboard\LeaveController;
use App\Http\Controllers\Dashboard\BranchController;
use App\Http\Controllers\Auth\EmployeeLoginController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\JobGradeController;
use App\Http\Controllers\Dashboard\LeaveBalanceController;
use App\Http\Controllers\Dashboard\FinanceCalendarController;

Route::get('/', function () {
    return view('welcome');
})->middleware(['redirect.employee']);



Route::middleware('auth:employee')->name('dashboard.')->group(function () {


    //------------------------ Profile
    Route::get('profile', [EmployeeController::class, 'profile'])
        ->name('profile');
    Route::post('profile', [EmployeeController::class, 'changePassword']);

    //------------------------ Logout
    Route::post('logout', [EmployeeLoginController::class, 'destroy'])
        ->name('employees.logout');

    // ---------------------------------------------------- بداية تكويد السنوات المالية
    Route::resource('/financeCalendars', FinanceCalendarController::class);
    Route::controller(FinanceCalendarController::class)->name('financeCalendars.')->prefix('financeCalendars')->group(function () {
        Route::get('open/{id}', 'open')->name('open');
        Route::get('close/{id}', 'close')->name('close');
    });


    // ---------------------------------------------- بداية تكويد الفروع
    Route::resource('/branches', BranchController::class);

    // --------------------------------------------- بداية تكويد الدرجات الوظيفية
    Route::resource('/jobGrades', JobGradeController::class);

    // ---------------------------------------------- بداية تكويد الموظفين
    Route::resource('/employees', EmployeeController::class);

    // --------------------------------------------- بداية رصيد الأجازات
    Route::resource('/leaveBalances', LeaveBalanceController::class);

    // ---------------------------------------------------- بداية تكويد الأجازات
    Route::resource('/leaves', LeaveController::class);

    Route::controller(LeaveController::class)->name('leaves.')->prefix('leaves')->group(function () {
        Route::get('/pending/employee', 'getLeavepending')->name('getLeavespending');
        Route::post('/balance', 'getLeaveBalance')->name('getLeavesBalances');
    });

    // ---------------------------------------------------- بداية تكويد الصفحه الامامين للمستخدمين
    Route::controller(EmployeePanel::class)->prefix('leave')->group(function () {
        Route::get('employee-panel/user', 'index')->name('employee-panel.index');
        Route::get('/data/{id}',  'showLeave')->name('leaves.showLeavesall');
        Route::get('/print/{id}',  'printLeave')->name('leaves.print');
    });
});




//----------------------------------------------------------- Login
Route::middleware('redirect.employee')->group(function () {
    Route::get('/login', [EmployeeLoginController::class, 'create'])->name('employees.login');
    Route::post('/login', [EmployeeLoginController::class, 'store']);
});




// ---------------------------------------------- بداية تكويد الصلاحيات
Route::middleware(['auth:employee', 'role:super-admin,employee'])
    ->name('dashboard.')
    ->group(function () {
        Route::prefix('roles')->controller(RoleController::class)->group(function () {
            Route::get('/', 'index')->name('roles.index');
            Route::get('/create', 'create')->name('roles.create');
            Route::post('/', 'store')->name('roles.store');
            Route::get('/{role}/edit', 'edit')->name('roles.edit');
            Route::put('/{role}', 'update')->name('roles.update');
            Route::delete('/{role}', 'destroy')->name('roles.destroy');

            // Permission specific routes
            Route::get('/{role}/give-permissions', 'addPermissionToRole')->name('roles.add-permission');
            Route::put('/{role}/give-permissions', 'givePermissionToRole')->name('roles.give-permission');
        });


        // ---------------------------------------------- بداية تكويد الأذونات
        Route::prefix('permissions')->controller(PermissionController::class)->group(function () {
            Route::get('/', 'index')->name('permission.index');
            Route::get('/create', 'create')->name('permission.create');
            Route::post('/', 'store')->name('permission.store');
            Route::get('/{role}/edit', 'edit')->name('permission.edit');
            Route::put('/{role}', 'update')->name('permission.update');
            Route::delete('/{role}', 'destroy')->name('permission.destroy');
        });
    });