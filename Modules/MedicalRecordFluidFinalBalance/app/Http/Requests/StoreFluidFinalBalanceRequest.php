<?php

namespace Modules\MedicalRecordFluidFinalBalance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFluidFinalBalanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'recorded_at.before_or_equal' => 'Waktu pencatatan tidak boleh di masa depan.',
        ];
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'period_date' => ['required', 'date'],
            'total_intake_ml' => ['required', 'numeric'],
            'total_output_ml' => ['required', 'numeric'],
            'balance_ml' => ['nullable', 'numeric'],
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
            'recorded_at' => ['nullable', 'date', 'before_or_equal:now'],
        ];
    }
}
