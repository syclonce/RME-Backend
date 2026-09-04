<?php

namespace Modules\MedicalRecordAnamnesis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnamnesisRequest extends FormRequest
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
            'present_illness_history' => ['nullable', 'string'],
            'past_medical_history' => ['nullable', 'string'],
            'family_medical_history' => ['nullable', 'string'],
            'allergy_history' => ['nullable', 'string'],
            'social_history' => ['nullable', 'string'],
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
            'recorded_at' => ['nullable', 'date', 'before_or_equal:now'],
        ];
    }
}
