<?php

namespace Modules\MedicalRecordInterventionProtocol\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterventionProtocolRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:active,completed,discontinued'],
        ];
    }
}
