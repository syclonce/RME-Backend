<?php

namespace Modules\LayananMedicalSupplyUsageItem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalSupplyUsageItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'quantity.min' => 'Jumlah minimal 1.',
        ];
    }

    public function rules(): array
    {
        return [
            'medical_supply_usage_id' => ['required', 'integer', 'exists:medical_supply_usages,id'],
            'item_id' => ['required', 'integer', 'exists:items,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'unit' => ['nullable', 'string', 'max:255'],
        ];
    }
}
