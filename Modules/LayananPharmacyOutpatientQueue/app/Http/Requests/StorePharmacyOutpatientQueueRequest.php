<?php

namespace Modules\LayananPharmacyOutpatientQueue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePharmacyOutpatientQueueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prescription_id' => ['required', 'integer', 'exists:prescriptions,id'],
            'queue_number' => ['required', 'string', 'max:255'],
            // status, called_at, completed_at TIDAK diterima saat create —
            // antrean baru selalu mulai 'waiting' (lihat
            // PharmacyOutpatientQueueService::create()).
        ];
    }
}
