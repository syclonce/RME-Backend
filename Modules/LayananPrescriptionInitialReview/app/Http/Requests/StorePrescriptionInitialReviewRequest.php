<?php

namespace Modules\LayananPrescriptionInitialReview\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionInitialReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: reviewed, revised.',
        ];
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['required', 'integer', 'exists:prescriptions,id'],
            'reviewed_by' => ['required', 'integer', 'exists:employees,id'],
            'reviewed_at' => ['required', 'date'],
            'is_appropriate' => ['sometimes', 'boolean'],
            'issues_found' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'status' => ['sometimes', 'string', 'in:reviewed,revised'],
        ];
    }
}
