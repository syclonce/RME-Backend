<?php

namespace Modules\LayananCriticalLabValue\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotifyCriticalLabValueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'notified_to' => ['required', 'string', 'max:255'],
        ];
    }
}
