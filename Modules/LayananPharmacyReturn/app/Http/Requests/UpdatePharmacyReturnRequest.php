<?php

namespace Modules\LayananPharmacyReturn\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePharmacyReturnRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: pending, approved, rejected.',
        ];
    }

    public function rules(): array
    {
        return [
            'prescription_item_id' => ['sometimes', 'integer', 'exists:prescription_items,id'],
            'quantity_returned' => ['sometimes', 'integer'],
            'reason' => ['sometimes', 'string', 'max:255'],
            'returned_by' => ['sometimes', 'integer', 'exists:employees,id'],
            'returned_at' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'in:pending,approved,rejected'],
        ];
    }
}
