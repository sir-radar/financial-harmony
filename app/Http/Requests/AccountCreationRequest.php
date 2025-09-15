<?php

namespace App\Http\Requests;

use App\Services\CryptoService;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class AccountCreationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:accounts,email',
            'account_number' => 'required|unique:accounts,account_number_index|max:10',
            'balance' => 'required|numeric',
            'ssn' => 'required',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            $crypto = app(CryptoService::class);

            if ($this->filled('account_number')) {
                $accountNumberIndex = $crypto->blindIndex('account_number', $this->input('account_number'));

                if (DB::table('accounts')->where('account_number_index', $accountNumberIndex)->exists()) {
                    $validator->errors()->add('account_number', 'The account number has already been taken.');
                }
            }

            if ($this->filled('ssn')) {
                $ssnIndex = $crypto->blindIndex('ssn', $this->input('ssn'));
                if (DB::table('accounts')->where('ssn_index', $ssnIndex)->exists()) {
                    $validator->errors()->add('ssn', 'The SSN has already been taken.');
                }
            }
        });
    }
}
