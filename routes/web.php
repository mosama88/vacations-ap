<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Front\EmployeePanel;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Dashboard\LeaveController;
use App\Http\Controllers\Auth\EmployeeLoginController;

Route::get('/', function () {
    return view('welcome');
})->middleware(['redirect.employee']);



Route::middleware('auth:employee')->group(function () {

    Route::get('employee-panel/user', [EmployeePanel::class, 'index'])->name('employee-panel.user');
    Route::get('leaves/pending', [EmployeePanel::class, 'getLeavepending'])->name('leaves.getLeavespending');
    Route::get('leaves/all', [EmployeePanel::class, 'allLeaves'])->name('leaves.all');



    // بداية تكويد الأجازات
    Route::resource('/leaves', LeaveController::class);
    Route::post('leaves/balance', [LeaveController::class, 'getLeaveBalance'])->name('leaves.getLeavesBalances');
    // Route::post('leaves/leaves/action', [LeaveController::class, 'getLeaveaction'])->name('leaves.getLeavesaction');
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

Route::middleware(['auth:employee', 'role:super-admin,employee'])
    ->name('dashboard.')
    ->group(function () {

        // Role Routes
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




        Route::prefix('permissions')->controller(PermissionController::class)->group(function () {
            Route::get('/', 'index')->name('permission.index');
            Route::get('/create', 'create')->name('permission.create');
            Route::post('/', 'store')->name('permission.store');
            Route::get('/{role}/edit', 'edit')->name('permission.edit');
            Route::put('/{role}', 'update')->name('permission.update');
            Route::delete('/{role}', 'destroy')->name('permission.destroy');
        });



        Route::prefix('users')->controller(UserController::class)->group(function () {
            Route::get('/', 'index')->name('users.index');
            Route::get('/create', 'create')->name('users.create');
            Route::post('/', 'store')->name('users.store');
            Route::get('/{role}/edit', 'edit')->name('users.edit');
            Route::put('/{role}', 'update')->name('users.update');
            Route::delete('/{role}', 'destroy')->name('users.destroy');
        });
    });