<?php

namespace Modules\PembayaranClaimInvoice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClaimInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('claim_invoice')?->id;

        return [
            // 'status' sengaja TIDAK ada di sini - transisi status lewat
            // endpoint PATCH /claim-invoices/{id}/transition
            // (ClaimInvoiceService), bukan PUT generik.
            'claim_number' => ['nullable', 'string', 'max:255', Rule::unique('claim_invoices', 'claim_number')->ignore($id)],
        ];
    }
}
