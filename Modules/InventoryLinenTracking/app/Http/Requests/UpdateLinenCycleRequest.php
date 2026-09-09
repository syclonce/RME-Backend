<?php

namespace Modules\InventoryLinenTracking\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLinenCycleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'status.in' => 'Status harus salah satu dari: dikirim_londri, dicuci, kembali_bersih, rusak_hilang.',
        ];
    }

    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'string', 'in:dikirim_londri,dicuci,kembali_bersih,rusak_hilang'],
            'sent_at' => ['sometimes', 'date'],
            'received_at' => ['sometimes', 'date'],
            'quantity' => ['sometimes', 'integer', 'min:1'],
        ];
    }
}
