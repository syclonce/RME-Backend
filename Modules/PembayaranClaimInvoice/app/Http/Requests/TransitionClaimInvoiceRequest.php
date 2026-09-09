<?php

namespace Modules\PembayaranClaimInvoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransitionClaimInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', Rule::in(['submitted', 'verified', 'paid', 'rejected'])],
            'verified_amount' => ['nullable', 'numeric', 'min:0'],
            'rejection_reason' => ['nullable', 'string'],
        ];
    }
}
