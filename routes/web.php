<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransactionStatsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [HomeController::class, 'index']);
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('authenticate', [AuthController::class, 'login'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('transactions', [TransactionsController::class, 'index'])->name('transactions');
    Route::get('stats', [TransactionStatsController::class, 'index'])->name('stats');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('update-password', [ProfileController::class, 'updatePassword'])->name('profile.password-reset');

    Route::get('users', [UsersController::class, 'index'])->name('users');
    Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('users', [UsersController::class, 'store'])->name('users.store');
    Route::get('users/{user_id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('users/{user_id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('users/{user_id}', [UsersController::class, 'destroy'])->name('users.destroy');


    Route::post('users/{user_id}/enable', [ProfileController::class, 'enable'])->name('users.enable');
    Route::post('users/{user_id}/disable', [ProfileController::class, 'disable'])->name('users.disable');


    Route::get('organizations', [OrganizationsController::class, 'index'])->name('organizations');
    Route::post('organizations/', [OrganizationsController::class, 'store'])->name('organizations.store');
    Route::get('organizations/{id}/edit', [OrganizationsController::class, 'edit'])->name('organizations.edit');
    Route::put('organizations/{id}/update', [OrganizationsController::class, 'update'])->name('organizations.update');
    Route::delete('organizations/{id}', [OrganizationsController::class, 'destroy'])->name('organizations.destroy');
});
