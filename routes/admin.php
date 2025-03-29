<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
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



Route::controller(RoleController::class)->group(function () {
    Route::middleware('permission:view role')->get('/roles', 'index');
    Route::middleware('permission:create role')->group(function () {
        Route::get('/roles/create', 'create')->name('roles.index');
        Route::post('/roles', 'store');
        Route::post('/roles/add-permission', 'addPermissionToRole');
        Route::post('/roles/give-permission', 'givePermissionToRole');
    });
    Route::middleware('permission:update role')->group(function () {
        Route::get('/roles/{role}/edit', 'edit');
        Route::put('/roles/{role}', 'update');
    });
    Route::middleware('permission:delete role')->delete('/roles/{role}', 'destroy');
});


Route::controller(PermissionController::class)
    ->middleware('role:admin') // Applies to all routes
    ->group(function () {
        Route::middleware('permission:create-product')->group(function () {
            Route::get('/permissions/create', 'create')->name('permissions.index');
            Route::post('/permissions', 'store');
        });

        Route::middleware('permission:edit-product')->group(function () {
            Route::get('/permissions/{permission}/edit', 'edit');
            Route::put('/permissions/{permission}', 'update');
        });

        Route::middleware('permission:delete-product')->delete('/permissions/{permission}', 'destroy');

        // Index doesn't need additional middleware beyond 'role:admin'
        Route::get('/permissions', 'index');
    });


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });