<?php

namespace Modules\MedicalRecordClinicalNoteCoManagement\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClinicalNoteCoManagementRequest extends FormRequest
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
            'clinical_note_id' => ['required', 'integer', 'exists:clinical_notes,id'],
            'medical_department_id' => ['required', 'integer', 'exists:medical_departments,id'],
            'notes' => ['nullable', 'string'],
            'author_id' => ['nullable', 'integer', 'exists:employees,id'],
            'recorded_at' => ['nullable', 'date', 'before_or_equal:now'],
        ];
    }
}
