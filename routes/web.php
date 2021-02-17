<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransactionStatsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

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
    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions');
    Route::get('/stats', [TransactionStatsController::class, 'index'])->name('stats');
});
