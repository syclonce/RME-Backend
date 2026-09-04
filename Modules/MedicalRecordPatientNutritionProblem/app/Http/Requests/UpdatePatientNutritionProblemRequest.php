<?php

namespace Modules\MedicalRecordPatientNutritionProblem\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientNutritionProblemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:open,in_progress,resolved'],
        ];
    }
}
