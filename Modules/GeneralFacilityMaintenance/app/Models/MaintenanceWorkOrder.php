<?php

namespace Modules\GeneralFacilityMaintenance\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralFacilityMaintenance\Database\Factories\MaintenanceWorkOrderFactory;

/**
 * Tiket perbaikan asset. State machine status (open -> in_progress ->
 * completed/cancelled) HANYA boleh diubah lewat
 * Modules\GeneralFacilityMaintenance\Services\MaintenanceWorkOrderService —
 * bukan tulisan langsung, supaya gerbang assign/complete tidak terlewati.
 */
class MaintenanceWorkOrder extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const PRIORITY_LOW = 'low';

    public const PRIORITY_MEDIUM = 'medium';

    public const PRIORITY_HIGH = 'high';

    public const PRIORITY_CRITICAL = 'critical';

    public const STATUS_OPEN = 'open';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'asset_id',
        'reported_by',
        'issue_description',
        'priority',
        'status',
        'assigned_to',
        'reported_at',
        'completed_at',
        'requires_manual_verification',
    ];

    protected function casts(): array
    {
        return [
            'reported_at' => 'datetime',
            'completed_at' => 'datetime',
            'requires_manual_verification' => 'boolean',
        ];
    }

    public function asset(): BelongsTo
    {
        return $this->belongsTo(MaintenanceAsset::class, 'asset_id');
    }

    public function reporter(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'reported_by');
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assigned_to');
    }

    protected static function newFactory(): MaintenanceWorkOrderFactory
    {
        return MaintenanceWorkOrderFactory::new();
    }
}
