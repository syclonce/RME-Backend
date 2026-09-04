<?php

namespace Modules\MedicalRecordControlSchedule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreControlScheduleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: scheduled, completed, cancelled.',
        ];
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'visit_id' => ['nullable', 'integer', 'exists:visits,id'],
            'medical_department_id' => ['nullable', 'integer', 'exists:medical_departments,id'],
            'scheduled_date' => ['required', 'date'],
            'purpose' => ['nullable', 'string'],
            'scheduled_by' => ['required', 'integer', 'exists:employees,id'],
            'status' => ['sometimes', 'string', 'in:scheduled,completed,cancelled'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
