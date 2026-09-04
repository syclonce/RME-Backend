<?php

namespace Modules\MedicalRecordInpatientCarePlan\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInpatientCarePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:active,completed,revised'],
        ];
    }
}
