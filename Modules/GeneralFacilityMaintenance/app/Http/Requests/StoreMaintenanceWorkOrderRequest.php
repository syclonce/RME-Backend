<?php

namespace Modules\GeneralFacilityMaintenance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\GeneralFacilityMaintenance\Models\MaintenanceWorkOrder;

class StoreMaintenanceWorkOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'asset_id' => ['required', 'integer', 'exists:maintenance_assets,id'],
            'reported_by' => ['nullable', 'integer', 'exists:employees,id'],
            'issue_description' => ['required', 'string'],
            'priority' => ['sometimes', 'string', 'in:' . implode(',', [
                MaintenanceWorkOrder::PRIORITY_LOW,
                MaintenanceWorkOrder::PRIORITY_MEDIUM,
                MaintenanceWorkOrder::PRIORITY_HIGH,
                MaintenanceWorkOrder::PRIORITY_CRITICAL,
            ])],
            'reported_at' => ['sometimes', 'date'],
        ];
    }
}
