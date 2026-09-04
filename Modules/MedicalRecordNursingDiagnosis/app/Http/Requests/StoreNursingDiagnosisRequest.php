<?php

namespace Modules\MedicalRecordNursingDiagnosis\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNursingDiagnosisRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: active, resolved.',
            'recorded_at.before_or_equal' => 'Waktu pencatatan tidak boleh di masa depan.',
        ];
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'diagnosis_label' => ['required', 'string', 'max:150'],
            'related_factors' => ['nullable', 'string'],
            'defining_characteristics' => ['nullable', 'string'],
            'priority' => ['nullable', 'string', 'max:20'],
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
            'recorded_at' => ['nullable', 'date', 'before_or_equal:now'],
            'status' => ['sometimes', 'string', 'in:active,resolved'],
        ];
    }
}
