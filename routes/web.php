<?php

use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/forget-password', function () {
    return view('forget-password');
});



Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/login', [UserController::class, 'loginView'])->name('loginView');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::middleware(['loginView'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'goDashboard'])->name('dashboard');
    Route::get('/dashboard/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/dashboard/setting', [UserController::class, 'profileSetting'])->name('setting');
    Route::post('/dashboard/update', [UserController::class, 'update'])->name('update');
});


// Manager Routes (Role Based)
Route::middleware(['role:manager'])->group(function () {

    Route::get('/dashboard/update-role', [ManagerController::class, 'changeRole'])->name('user.change.role');
    Route::post('/dashboard/update-role', [ManagerController::class, 'changeRoleUpdate'])->name('changeRoleUpdate');

    Route::get('/dashboard/user-create', [ManagerController::class, 'userCreateShow'])->name('user.create.show');
    Route::post('/dashboard/user-create', [ManagerController::class, 'userCreate'])->name('user.create');
});



// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ManagerController;
// use App\Http\Controllers\AccountantController;
// use App\Http\Controllers\OperationsController;
// use App\Http\Controllers\MemberController;
// use App\Http\Controllers\ReportController;

// Route::get('/', function () {
//     return redirect()->route('login');
// });

// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::middleware(['auth', 'role:manager'])->group(function () {
//     Route::get('/manager/dashboard', [ManagerController::class, 'index'])->name('manager.dashboard');
//     Route::get('/manager/users', [ManagerController::class, 'users'])->name('manager.users');
//     Route::post('/manager/users', [ManagerController::class, 'storeUser'])->name('manager.users.store');
//     Route::get('/manager/reports', [ReportController::class, 'index'])->name('manager.reports');
// });

// Route::middleware(['auth', 'role:accountant'])->group(function () {
//     Route::get('/accountant/dashboard', [AccountantController::class, 'index'])->name('accountant.dashboard');
//     Route::post('/accountant/payment', [AccountantController::class, 'storePayment'])->name('accountant.payment.store');
//     Route::post('/accountant/expense', [AccountantController::class, 'storeExpense'])->name('accountant.expense.store');
// });

// Route::middleware(['auth', 'role:operations'])->group(function () {
//     Route::get('/operations/dashboard', [OperationsController::class, 'index'])->name('operations.dashboard');
//     Route::post('/operations/bazar', [OperationsController::class, 'storeBazar'])->name('operations.bazar.store');
//     Route::post('/operations/meal', [OperationsController::class, 'storeMeal'])->name('operations.meal.store');
// });

// Route::middleware(['auth', 'role:member'])->group(function () {
//     Route::get('/member/dashboard', [MemberController::class, 'index'])->name('member.dashboard');
// });
