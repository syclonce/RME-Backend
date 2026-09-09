<?php

namespace Modules\PembayaranInvoiceSubsidy\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\PembayaranInvoiceSubsidy\Models\InvoiceSubsidy;

class UpdateInvoiceSubsidyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'status' sengaja TIDAK ada di sini - transisi status lewat
            // endpoint PATCH /invoice-subsidies/{id}/transition
            // (InvoiceSubsidyService), bukan PUT generik.
            'subsidy_source' => ['sometimes', Rule::in(InvoiceSubsidy::SUBSIDY_SOURCES)],
            'subsidy_amount' => ['sometimes', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
