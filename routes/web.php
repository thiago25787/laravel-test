<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::prefix("/")->middleware("auth")->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('account')->group(function () {
        Route::get('/', [App\Http\Controllers\AccountController::class, 'index'])->name('account');
        Route::get('/store', [App\Http\Controllers\AccountController::class, 'store'])->name('account.store');
    });
    Route::prefix('deposit')->group(function () {
        Route::get('/', [App\Http\Controllers\DepositController::class, 'index'])->name('deposit');
        Route::get('/create', [App\Http\Controllers\DepositController::class, 'create'])->name('deposit.create');
        Route::post('/{account}', [App\Http\Controllers\DepositController::class, 'store'])->name('deposit.store')->where(['account' => '[0-9]+']);
        Route::get('/approving', [App\Http\Controllers\ApproveController::class, 'index'])->name('deposit.approve');
        Route::get('/approve/{deposit}', [App\Http\Controllers\ApproveController::class, 'store'])->name('deposit.approve.store')->where(['deposit' => '[0-9]+']);
        Route::get('/deny/{deposit}', [App\Http\Controllers\ApproveController::class, 'destroy'])->name('deposit.deny.destroy')->where(['deposit' => '[0-9]+']);
    });
    Route::prefix('purchase')->group(function () {
        Route::get('/', [App\Http\Controllers\PurchaseController::class, 'index'])->name('purchase');
        Route::get('/create', [App\Http\Controllers\PurchaseController::class, 'create'])->name('purchase.create');
        Route::post('/{account}', [App\Http\Controllers\PurchaseController::class, 'store'])->name('purchase.store')->where(['account' => '[0-9]+']);
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user');
        Route::get('/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile');
        Route::post('/', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    });
});
