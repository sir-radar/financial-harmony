<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::post('/accounts', [AccountController::class, 'create']);
Route::get('/accounts/number/{number}', [AccountController::class, 'findByNumber']);
Route::get('/accounts/ssn/{ssn}', [AccountController::class, 'findBySsn']);
Route::get('/accounts/balance/{min}/{max}', [AccountController::class, 'findByBalanceRange']);

Route::post('/transactions', [TransactionController::class, 'create']);
Route::get('/transactions/account/{accountNumber}', [TransactionController::class, 'findByAccountNumber']);
Route::get('/transaction/amount/{min}/{max}', [TransactionController::class, 'findByAmountRange']);