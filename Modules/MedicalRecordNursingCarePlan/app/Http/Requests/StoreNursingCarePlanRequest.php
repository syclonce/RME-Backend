<?php

namespace Modules\MedicalRecordNursingCarePlan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNursingCarePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: active, completed, cancelled.',
            'recorded_at.before_or_equal' => 'Waktu pencatatan tidak boleh di masa depan.',
        ];
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'assessment' => ['nullable', 'string'],
            'goal' => ['nullable', 'string'],
            'intervention_plan' => ['nullable', 'string'],
            'target_date' => ['nullable', 'date'],
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
            'recorded_at' => ['nullable', 'date', 'before_or_equal:now'],
            'status' => ['sometimes', 'string', 'in:active,completed,cancelled'],
        ];
    }
}
