<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountCreationRequest;
use App\Models\Account;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function create(AccountCreationRequest $request)
    {
        $account = Account::create($request->validated());
        return response()->json($account);
    }

    public function findByNumber(string $number)
    {
        try {
            return response()->json(Account::findByAccountNumber($number));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Account number ' . $number . ' not found'], 404);
        }
    }

    public function findBySsn(string $ssn)
    {
        try {
            return response()->json(Account::findBySsn($ssn));
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Account with SSN ' . $ssn . ' not found'], 404);
        }
    }

    public function findByBalanceRange(float $min, float $max)
    {
        return response()->json(Account::findByBalanceRange($min, $max));
    }
}
