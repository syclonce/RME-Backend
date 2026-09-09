<?php

namespace Modules\MedicalRecordPlanAndTherapy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanAndTherapyRequest extends FormRequest
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
