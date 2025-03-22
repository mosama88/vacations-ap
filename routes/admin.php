<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\FinanceCalendarController;


Route::middleware('auth:admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    //--------------------------------------- Finance Calendars
    Route::resource('/financeCalendars', FinanceCalendarController::class);
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