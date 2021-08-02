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

Route::get('/', function () { return redirect('login'); });
Route::get('/login', \App\Http\Livewire\Auth\Login::class)->name('login');

Route::prefix("/")->middleware("auth")->group(function() {
    Route::get('/dashboard', \App\Http\Livewire\Account\Balance::class)->name('dashboard');
    Route::prefix("/deposit")->group(function(){
        Route::get('/', \App\Http\Livewire\Deposit\Index::class)->name('deposit');
        Route::get('/approve', \App\Http\Livewire\Deposit\Approve::class)->name('deposit.approve');
    });
    Route::get('/purchase', \App\Http\Livewire\Purchase\Index::class)->name('purchase');
});

