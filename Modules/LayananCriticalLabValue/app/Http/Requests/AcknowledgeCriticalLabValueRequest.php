<?php

namespace Modules\LayananCriticalLabValue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcknowledgeCriticalLabValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Tidak ada payload — siapa (user login) dan kapan (now()) diambil
        // dari konteks request oleh CriticalLabValueService::acknowledge().
        return [];
    }
}
