<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BazarController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ManagerController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/forget-password', function () {
    return view('forget-password');
});

//login and Log Out
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
// Meals Show


Route::middleware(['logedin'])->group(function () {
    Route::get('/login', [UserController::class, 'loginView'])->name('loginView');
});
Route::middleware(['loginView'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'goDashboard'])->name('dashboard');
    Route::get('/dashboard/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/dashboard/setting', [UserController::class, 'profileSetting'])->name('setting');
    Route::post('/dashboard/update', [UserController::class, 'update'])->name('update');
    Route::get('/dashboard/meals', [MealController::class, 'index'])->name('index');
    Route::post('/dashboard/meals/store', [MealController::class, 'store'])->name('meal.store');
    Route::get('/dashboard/meals/today', [MealController::class, 'todayMeals'])->name('meals.today');
    Route::delete('/dashboard/meals/delete/{id}', [MealController::class, 'deleteMeal'])->name('meal.delete');
    Route::get('/dashboard/meals/search', [MealController::class, 'mealSearch'])->name('meals.search');
    Route::get('/dashboard/bill', [BillController::class, 'index'])->name('bill.index');
    Route::post('/dashboard/bill/store', [BillController::class, 'storeBill'])->name('bill.store');
});



Route::middleware(['auth', 'role:operations'])->group(function () {
    Route::get('/dashboard/bazar/{id?}', [BazarController::class, 'viewBazar'])->name('bazar.view');
    Route::post('/dashboard/bazar', [BazarController::class, 'storeBazar'])->name('bazar.store');
    Route::get('/dashboard/bazar/show/{id}', [BazarController::class, 'showRecipt'])->name('bazar.show');
    Route::delete('/dashboard/bazar/delete/{id}', [BazarController::class, 'deleteBazar'])->name('bazar.delete');
    Route::put('/dashboard/bazar/update/{id}', [BazarController::class, 'updateBazar'])->name('bazar.update');
});

// Manager Routes (Role Based)
Route::middleware(['role:manager'])->group(function () {
    Route::get('/dashboard/update-role', [ManagerController::class, 'changeRole'])->name('user.change.role');
    Route::post('/dashboard/update-set', [ManagerController::class, 'changeSet'])->name('user.change.set');
    Route::post('/dashboard/update-role', [ManagerController::class, 'changeRoleUpdate'])->name('changeRoleUpdate');
    Route::get('/dashboard/user-create', [ManagerController::class, 'userCreateShow'])->name('user.create.show');
    Route::post('/dashboard/user-create', [ManagerController::class, 'userCreate'])->name('user.create');
    Route::delete('/dashboard/delete/{id}', [ManagerController::class, 'deleteUser'])->name('user.delete');
});


Route::middleware(['auth', 'role:accountant'])->group(function () {
    // Route::get('/accountant/dashboard', [AccountantController::class, 'index'])->name('accountant.dashboard');
    // Route::post('/accountant/payment', [AccountantController::class, 'storePayment'])->name('accountant.payment.store');
    // Route::post('/accountant/expense', [AccountantController::class, 'storeExpense'])->name('accountant.expense.store');
});
