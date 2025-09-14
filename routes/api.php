<?php

use Illuminate\Support\Facades\Route;

Route::post('/accounts', [App\Http\Controllers\AccountController::class, 'create']);
Route::get('/accounts/number/{number}', [App\Http\Controllers\AccountController::class, 'findByNumber']);
Route::get('/accounts/ssn/{ssn}', [App\Http\Controllers\AccountController::class, 'findBySsn']);
Route::get('/accounts/balance/{min}/{max}', [App\Http\Controllers\AccountController::class, 'findByBalanceRange']);

Route::post('/transactions', [App\Http\Controllers\TransactionController::class, 'create']);
Route::get('/transactions/account/{accountNumber}', [App\Http\Controllers\TransactionController::class, 'findByAccountNumber']);
Route::get('/transaction/amount/{min}/{max}', [App\Http\Controllers\TransactionController::class, 'findByAmountRange']);
