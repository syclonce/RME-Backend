<?php

namespace Modules\MedicalRecordImplementation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImplementationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: completed, cancelled.',
        ];
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'order_reference' => ['nullable', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'performed_by' => ['nullable', 'integer', 'exists:employees,id'],
            'performed_at' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'in:completed,cancelled'],
        ];
    }
}
