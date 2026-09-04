<?php

namespace Modules\PembayaranInvoiceSubsidy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransitionInvoiceSubsidyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', Rule::in(['approved', 'rejected'])],
        ];
    }
}
