<?php

namespace Modules\LayananCriticalLabValue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCriticalLabValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // notified_to/notified_at/acknowledged SENGAJA tidak lagi di sini:
            // status notifikasi & pengakuan hanya boleh berubah lewat gerbang
            // eksplisit CriticalLabValueController::notify()/acknowledge(),
            // supaya aturan "tidak bisa acknowledged sebelum notified" dan
            // jejak siapa/kapan tidak bisa dilewati lewat edit bebas.
            'lab_order_id' => ['sometimes', 'integer', 'exists:lab_orders,id'],
            'parameter_name' => ['sometimes', 'string', 'max:255'],
            'critical_value' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
