<?php

namespace Modules\LayananCriticalLabValue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCriticalLabValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // notified_to/notified_at/acknowledged TIDAK diterima saat create:
            // sebuah nilai kritis baru selalu lahir belum diberitahukan &
            // belum diakui — status itu hanya berubah lewat
            // CriticalLabValueController::notify()/acknowledge().
            'lab_order_id' => ['required', 'integer', 'exists:lab_orders,id'],
            'parameter_name' => ['required', 'string', 'max:255'],
            'critical_value' => ['required', 'string', 'max:255'],
        ];
    }
}
