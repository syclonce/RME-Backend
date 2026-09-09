<?php

namespace Modules\LayananMedicalSupplyUsage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicalSupplyUsageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'recorded_by' => ['nullable', 'integer', 'exists:users,id'],
            'used_at' => ['required', 'date'],
        ];
    }
}
