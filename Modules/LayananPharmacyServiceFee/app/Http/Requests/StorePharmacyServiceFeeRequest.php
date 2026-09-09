<?php

namespace Modules\LayananPharmacyServiceFee\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyServiceFeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'amount.min' => 'Nominal tidak boleh negatif.',
        ];
    }

    public function rules(): array
    {
        return [
            'item_id' => ['nullable', 'integer', 'exists:items,id'],
            'fee_name' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
