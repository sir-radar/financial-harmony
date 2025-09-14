<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionCreationRequest;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function create(TransactionCreationRequest $request)
    {
        $data = $request->validated();


        $account = Account::findByAccountNumber($data['account_number'])->first();

        $data['account_id'] = $account->id;
        unset($data['account_number']);

        $transaction = DB::transaction(function () use ($data) {
            // Lock account row for update to avoid race conditions
            $account = Account::lockForUpdate()->findOrFail($data['account_id']);

            $amount = (float) $data['amount'];

            if ($data['type'] === 'withdrawal') {
                if ($account->balance < $amount) {
                    throw new \RuntimeException('Insufficient funds.');
                }
                $account->balance = $account->balance - $amount;
            } else { // deposit
                $account->balance = $account->balance + $amount;
            }

            $account->save();

            // Create transaction record
            return Transaction::create($data);
        });

        return response()->json($transaction);
    }

    public function findByAccountNumber(string $accountNumber)
    {
        return response()->json(Transaction::findByAccountNumber($accountNumber));
    }

    public function findByAmountRange(float $min, float $max)
    {
        return response()->json(Transaction::findByAmountRange($min, $max));
    }
}
