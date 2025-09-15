<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreationRequest extends FormRequest
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
            'account_number' => 'required|max:10',
            'amount' => 'required|numeric',
            'type' => 'required|in:withdrawal,deposit',
            'description' => 'nullable|string',
            'card_number' => 'required|string',
            'cvv' => 'required|string',
        ];
    }
}
