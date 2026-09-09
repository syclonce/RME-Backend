<?php

namespace Modules\BerkasKlaimPharmacyClaim\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransitionPharmacyClaimRequest extends FormRequest
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
