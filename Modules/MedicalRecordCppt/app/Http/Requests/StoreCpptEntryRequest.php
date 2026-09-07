<?php

namespace Modules\MedicalRecordCppt\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCpptEntryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'recorded_at' => ['nullable', 'date', 'before_or_equal:now'],
            'subjective' => ['nullable', 'string'],
            'objective' => ['nullable', 'string'],
            'assessment' => ['nullable', 'string'],
            'plan' => ['nullable', 'string'],
            'instruction' => ['nullable', 'string'],
            'profession' => ['nullable', 'string', 'max:50'],
            'recorded_by' => ['nullable', 'integer', 'exists:employees,id'],
        ];
    }
}
