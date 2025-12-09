<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BazarController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/forget-password', function () {
    return view('forget-password');
});


//login and Log Out
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/forget/password', [UserController::class, 'forgetPassword'])->name('forget.password');
Route::get('/reset/password/{token}', [UserController::class, 'resetPasswordForm'])->name('reset.password.form');
Route::post('/reset/password', [UserController::class, 'resetPassword'])->name('reset.password');



Route::middleware(['logedin'])->group(function () {
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.form');
});




Route::middleware(['loginView',])->group(function () {
    Route::get('/dashboard', [UserController::class, 'goDashboard'])->name('dashboard');
    Route::get('/dashboard/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/dashboard/update', [UserController::class, 'update'])->name('update');

    Route::get('/profile/active/', [UserController::class, 'activeProfileForm'])->name('active.profile.form');
    Route::post('/profile/active/', [UserController::class, 'activeProfile'])->name('active.profile');
    Route::get('/profile/active/success/{token}', [UserController::class, 'activeSuccess'])->name('active.success');
    // Meals Show
    Route::get('/dashboard/meals', [MealController::class, 'index'])->name('index');
    Route::post('/dashboard/meals/store', [MealController::class, 'store'])->name('meal.store');
    Route::post('/dashboard/update/password', [UserController::class, 'updatePassword'])->name('password.update');
    Route::get('/dashboard/payment/history', [PaymentController::class, 'paymentHistory'])->name('payment.history');
});

Route::middleware(['role:operations'])->group(function () {
    Route::get('/dashboard/bazar/{id?}', [BazarController::class, 'viewBazar'])->name('bazar.view');
    Route::post('/dashboard/bazar', [BazarController::class, 'storeBazar'])->name('bazar.store');
    Route::get('/dashboard/bazar/show/{id}', [BazarController::class, 'showRecipt'])->name('bazar.show');
    Route::delete('/dashboard/bazar/delete/{id}', [BazarController::class, 'deleteBazar'])->name('bazar.delete');
    Route::put('/dashboard/bazar/update/{id}', [BazarController::class, 'updateBazar'])->name('bazar.update');
});

// Manager Routes (Role Based)
Route::middleware(['role:manager'])->group(function () {
    Route::get('/dashboard/update/role', [ManagerController::class, 'changeRole'])->name('user.change.role');
    Route::post('/dashboard/update/set', [ManagerController::class, 'changeSet'])->name('user.change.set');
    Route::post('/dashboard/update/role', [ManagerController::class, 'changeRoleUpdate'])->name('changeRoleUpdate');
    Route::get('/dashboard/user/create', [ManagerController::class, 'userCreateShow'])->name('user.create.show');
    Route::post('/dashboard/user/create', [ManagerController::class, 'userCreate'])->name('user.create');
    Route::delete('/dashboard/delete/{id}', [ManagerController::class, 'deleteUser'])->name('user.delete');
    Route::get('/dashboard/edit/{id}', [ManagerController::class, 'editUser'])->name('user.edit');
    Route::post('/dashboard/update/{id}', [ManagerController::class, 'updateUser'])->name('user.update');
});


Route::middleware(['auth', 'role:manager|accountant'])->group(function () {

    Route::get('/dashboard/bill/{month?}', [BillController::class, 'index'])->name('bill.index');
    Route::post('/dashboard/bill/store', [BillController::class, 'storeBill'])->name('bill.store');
    Route::put('/dashboard/bill/update/{id}', [BillController::class, 'updateBill'])->name('bill.update');
    Route::delete('/dashboard/bill/delete/{id}', [BillController::class, 'billDelete'])->name('bill.delete');


    Route::get('/dashboard/payment', [PaymentController::class, 'payment'])->name('payment.index');
    Route::post('/dashboard/payment/store', [PaymentController::class, 'makePayment'])->name('payment.store');
    Route::get('/dashboard/payment/edit/{id}', [PaymentController::class, 'paymentEdit'])->name('payment.edit');
    Route::post('/dashboard/payment/update/{id}', [PaymentController::class, 'paymentupdate'])->name('payment.update');
});

Route::middleware(['auth', 'role:manager|operations'])->group(function () {

    Route::get('/dashboard/meals/today', [MealController::class, 'todayMeals'])->name('meals.today');
    Route::delete('/dashboard/meals/delete/{id}', [MealController::class, 'deleteMeal'])->name('meal.delete');
    Route::get('/dashboard/meals/search', [MealController::class, 'mealSearch'])->name('meals.search');
});
