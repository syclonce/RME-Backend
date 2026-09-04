<?php

namespace Modules\MedicalRecordSocialCondition\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSocialConditionRequest extends FormRequest
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
            'living_situation' => ['nullable', 'string', 'max:150'],
            'occupation_status' => ['nullable', 'string', 'max:100'],
            'financial_status' => ['nullable', 'string', 'max:100'],
            'support_system' => ['nullable', 'string'],
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
            'recorded_at' => ['nullable', 'date', 'before_or_equal:now'],
        ];
    }
}
