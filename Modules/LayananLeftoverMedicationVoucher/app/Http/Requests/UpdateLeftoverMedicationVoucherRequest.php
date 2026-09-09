<?php

namespace Modules\LayananLeftoverMedicationVoucher\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLeftoverMedicationVoucherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(['redeemed', 'expired'])],
            // redeemed_at SENGAJA tidak divalidasi di sini -- server yang
            // menstempel waktu redeem saat transisi terjadi (lihat
            // LeftoverMedicationVoucherService::transition()), bukan nilai
            // kiriman klien.
        ];
    }
}
