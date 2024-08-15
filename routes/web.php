<?php

use App\Http\Controllers\HolidayController;
use App\Models\Leaf;
use App\Models\Leave;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\ViewController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\LeaveManagementController;

Route::get('/', function () {
    return view('auth.login');
});


//Route::get('/', function () {
//  return view('welcome');
// });



Route::get('dashboard', function () {
    return view('leaves.dashboard');
})->middleware(['auth', 'verified'])->name('leaves.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/dashboard', [LeaveController::class, 'index'])->name('leaves.dashboard');
    Route::get('/create', [LeaveController::class, 'create'])->name('leaves.create');
    Route::post('/create', [LeaveController::class, 'store'])->name('leaves.store');

    Route::get('/leaves/edit/{id}', [LeaveController::class, 'edit'])->name('leaves.edit');
    Route::patch('/leaves/edit/{leave}', [LeaveController::class, 'update'])->name('leaves.edit');

    Route::get('/leaves/{id}', [LeaveController::class, 'show'])->name('leaves.show');

    Route::post('/cancel/{id}', [LeaveController::class, 'cancel'])->name('cancel');

    Route::get('admin/dashboard', [LeaveManagementController::class, 'data'])->name('admin.dashboard');

    Route::get('/admin/{id}', [LeaveManagementController::class, 'approval'])->name('admin.approval');

    Route::post('/leaves/approval/{id}', [LeaveManagementController::class, 'approve'])->name('leaves.approval');

    Route::post('/decline/{id}', [LeaveManagementController::class, 'decline'])->name('decline');

    Route::get('/leave/{id}', [LeaveManagementController::class, 'approval'])->name('leave.approval');

    Route::patch('/admin/approval/{leave}', [LeaveManagementController::class, 'update'])->name('approval');

    Route::get('/users', [UsersController::class, 'data'])->name('admin.users');

    Route::get('/createuser', [UsersController::class, 'create'])->name('admin.createuser');

    Route::post('/createuser', [UsersController::class, 'store'])->name('admin.createuser');

    Route::post('/giveaccess/{id}', [UsersController::class, 'giveaccess'])->name('giveaccess');

    Route::post('/blockaccess/{id}', [UsersController::class, 'blockaccess'])->name('blockaccess');

    Route::post('/createleavetypes', [LeaveTypeController::class, 'store'])->name('createleavetypes.store');
    
    Route::get('/createleavetypes', [LeaveTypeController::class, 'data'])->name('admin.createleavetypes');

    Route::delete('/destroyleavetypes/{id}', [LeaveTypeController::class, 'destroyleavetypes'])->name('destroyleavetypes'); //

    Route::delete('/destroyuser/{id}', [UsersController::class, 'destroyuser'])->name('destroyuser');

    Route::post('/holidays', [HolidayController::class, 'store'])->name('holidays.store');

    Route::get('/holidays', [HolidayController::class, 'holidays'])->name('admin.holidays');

    Route::patch('/updateHoliday', [HolidayController::class, 'updateHoliday'])->name('updateHoliday');

    Route::get('/fetch-holidays', 'App\Http\Controllers\HolidayController@fetchHolidays')->name('fetch-holidays');
    Route::post('/update-leave-balance/{leaveTypeId}', 'LeaveBalanceController@updateLeaveBalance')->name('leave-balance.update');


/*Route::get('/settings', function () {
  return view('admin.settings');
 })->name ('admin.settings');                        
    */

    Route::patch('/holidays', [HolidayController::class, 'updateHoliday'])->name('updateHoliday');

    //Route::patch('/holidays', [HolidayController::class, 'update'])->name('update');
    Route::get('/holidays/{id}/edit', [HolidayController::class, 'editJson']);
    //Route::patch('/holidays/{id}', [HolidayController::class, 'update'])->name('update');



});

require __DIR__ . '/auth.php';


Route::get('forgot-password', function () {
    return view('auth.forgot-password');
});
