<?php

namespace Modules\BerkasKlaimRadiologyClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransitionRadiologyClaimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', Rule::in(['submitted', 'approved', 'rejected'])],
        ];
    }
}
