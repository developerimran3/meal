<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BazarController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\OperationsController;

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
});



Route::middleware(['auth', 'role:operations'])->group(function () {
    Route::get('/dashboard/bazar', [BazarController::class, 'viewBazar'])->name('bazar.view');
    Route::post('/dashboard/bazar', [BazarController::class, 'storeBazar'])->name('bazar.store');
});

// Manager Routes (Role Based)
Route::middleware(['role:manager'])->group(function () {
    Route::get('/dashboard/update-role', [ManagerController::class, 'changeRole'])->name('user.change.role');
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
