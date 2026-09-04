<?php

namespace Modules\LayananRadiologyOrder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\LayananRadiologyOrder\Models\RadiologyOrder;

class UpdateRadiologyOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Hanya status yang bisa disunting lewat endpoint ini — lihat
            // RadiologyOrderController::update() dan RadiologyOrderService::transition().
            // 'scheduled' disertakan di sini untuk validasi input umum, tapi jalur
            // yang dianjurkan untuk masuk ke 'scheduled' adalah endpoint khusus
            // POST .../schedule (mengisi scheduled_at juga) — lihat RadiologyOrderService::schedule().
            'status' => ['required', Rule::in(RadiologyOrder::STATUSS)],
        ];
    }
}
