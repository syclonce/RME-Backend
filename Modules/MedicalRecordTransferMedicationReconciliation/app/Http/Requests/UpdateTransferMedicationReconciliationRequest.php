<?php

namespace Modules\MedicalRecordTransferMedicationReconciliation\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransferMedicationReconciliationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:draft,completed'],
        ];
    }
}
