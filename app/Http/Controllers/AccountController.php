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

        return response()->json(Account::findByAccountNumber($number));
    }

    public function findBySsn(string $ssn)
    {

        return response()->json(Account::findBySsn($ssn));
    }

    public function findByBalanceRange(float $min, float $max)
    {
        return response()->json(Account::findByBalanceRange($min, $max));
    }
}
