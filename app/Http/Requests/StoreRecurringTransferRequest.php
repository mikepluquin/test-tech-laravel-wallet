<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecurringTransferRequest extends SendMoneyRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'frequency_days' => 'required|integer|min:1',
            'start_date' => ['required', 'date', Rule::date()->after(today()),
            'end_date' => 'required|date,gt:start_date',
        ]);
    }
}
