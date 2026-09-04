<?php

namespace Modules\MedicalRecordNursingIndicatorImplementation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNursingIndicatorImplementationRequest extends FormRequest
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
            'nursing_indicator_id' => ['required', 'integer', 'exists:nursing_indicators,id'],
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'value_recorded' => ['required', 'string', 'max:100'],
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
            'recorded_at' => ['nullable', 'date', 'before_or_equal:now'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
