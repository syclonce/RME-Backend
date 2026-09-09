<?php

namespace Modules\MedicalRecordInterventionRecommendation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInterventionRecommendationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: open, accepted, declined.',
        ];
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'source' => ['nullable', 'string', 'max:100'],
            'recommendation' => ['nullable', 'string'],
            'priority' => ['nullable', 'string', 'max:20'],
            'recommended_by' => ['required', 'integer', 'exists:employees,id'],
            'recommended_at' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'in:open,accepted,declined'],
        ];
    }
}
