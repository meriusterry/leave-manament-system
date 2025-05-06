<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveManagementController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('dashboard', function () {
    return view('leaves.dashboard');
})->middleware(['auth', 'verified'])->name('leaves.dashboard');

// Routes for authenticated users
Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Leave request routes
    Route::get('/dashboard', [LeaveController::class, 'index'])->name('leaves.dashboard');
    Route::get('/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('/create', [LeaveController::class, 'store'])->name('leaves.store');
    Route::get('/leaves/edit/{id}', [LeaveController::class, 'edit'])->name('leaves.edit');
    Route::patch('/leaves/edit/{leave}', [LeaveController::class, 'update'])->name('leaves.edit');
    Route::get('/leaves/{id}', [LeaveController::class, 'show'])->name('leaves.show');
    Route::post('/cancel/{id}', [LeaveController::class, 'cancel'])->name('cancel');

    // Routes only accessible to admins
    Route::middleware('admin')->group(function () {

        // Admin dashboard & approval
        Route::get('admin/dashboard', [LeaveManagementController::class, 'data'])->name('admin.dashboard');
        Route::get('/admin/{id}', [LeaveManagementController::class, 'approval'])->name('admin.approval');
        Route::get('/leave/{id}', [LeaveManagementController::class, 'approval'])->name('leave.approval');
        Route::post('/leaves/approval/{id}', [LeaveManagementController::class, 'approve'])->name('leaves.approval');
        Route::post('/decline/{id}', [LeaveManagementController::class, 'decline'])->name('decline');
        Route::patch('/admin/approval/{leave}', [LeaveManagementController::class, 'update'])->name('approval');

        // User management
        Route::get('/users', [UsersController::class, 'data'])->name('admin.users');
        Route::get('/createuser', [UsersController::class, 'create'])->name('admin.createuser');
        Route::post('/createuser', [UsersController::class, 'store'])->name('admin.createuser');
        Route::post('/giveaccess/{id}', [UsersController::class, 'giveaccess'])->name('giveaccess');
        Route::post('/blockaccess/{id}', [UsersController::class, 'blockaccess'])->name('blockaccess');
        Route::delete('/destroyuser/{id}', [UsersController::class, 'destroyuser'])->name('destroyuser');

        // Leave types
        Route::get('/createleavetypes', [LeaveTypeController::class, 'data'])->name('admin.createleavetypes');
        Route::post('/createleavetypes', [LeaveTypeController::class, 'store'])->name('createleavetypes.store');
        Route::delete('/destroyleavetypes/{id}', [LeaveTypeController::class, 'destroyleavetypes'])->name('destroyleavetypes');

        // Holidays
        Route::get('/holidays', [HolidayController::class, 'holidays'])->name('admin.holidays');
        Route::post('/holidays', [HolidayController::class, 'store'])->name('holidays.store');
        Route::patch('/updateHoliday', [HolidayController::class, 'updateHoliday'])->name('updateHoliday');
        Route::get('/holidays/{id}/edit', [HolidayController::class, 'editJson']);
    });

    // Shared by all authenticated users (admin or not)
    Route::get('/fetch-holidays', [HolidayController::class, 'fetchHolidays'])->name('fetch-holidays');
    Route::post('/update-leave-balance/{leaveTypeId}', [\App\Http\Controllers\LeaveBalanceController::class, 'updateLeaveBalance'])->name('leave-balance.update');
});

require __DIR__ . '/auth.php';

Route::get('forgot-password', function () {
    return view('auth.forgot-password');
});
