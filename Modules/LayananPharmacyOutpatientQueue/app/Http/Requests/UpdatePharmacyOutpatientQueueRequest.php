<?php

namespace Modules\LayananPharmacyOutpatientQueue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePharmacyOutpatientQueueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['called', 'done'])],
        ];
    }
}
