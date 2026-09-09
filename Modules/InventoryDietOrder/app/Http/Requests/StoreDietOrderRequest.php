<?php

namespace Modules\InventoryDietOrder\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\InventoryDietOrder\Models\DietOrder;

class StoreDietOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'visit_id' => ['required', 'integer', 'exists:visits,id'],
            'diet_type' => ['required', 'string', Rule::in(DietOrder::DIET_TYPES)],
            'calorie_target' => ['nullable', 'integer', 'min:0'],
            'allergy_notes' => ['nullable', 'string'],
            'meal_schedule' => ['required', 'string', Rule::in(DietOrder::MEAL_SCHEDULES)],
            'ordered_by' => ['nullable', 'integer', 'exists:employees,id'],
            'order_date' => ['required', 'date'],
        ];
    }
}
