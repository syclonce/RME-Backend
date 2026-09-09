<?php

namespace Modules\LayananExaminationResultStatus\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExaminationResultStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: pending, completed, cancelled.',
        ];
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['sometimes', 'integer', 'exists:visits,id'],
            'examination_type' => ['sometimes', 'string', 'max:100'],
            'status' => ['sometimes', 'string', 'in:pending,completed,cancelled'],
            'verified_by' => ['nullable', 'integer', 'exists:employees,id'],
            'verified_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
