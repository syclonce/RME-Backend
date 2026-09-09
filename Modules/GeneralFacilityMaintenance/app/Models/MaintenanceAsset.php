<?php

namespace Modules\GeneralFacilityMaintenance\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\GeneralFacilityMaintenance\Database\Factories\MaintenanceAssetFactory;
use Modules\GeneralWard\Models\Ward;

/**
 * Aset sarana-prasarana yang dipelihara IPSRS.
 *
 * Transisi operational <-> under_repair adalah efek samping work order dan
 * HANYA terjadi lewat Modules\GeneralFacilityMaintenance\Services\MaintenanceWorkOrderService
 * (under_repair saat WO dibuat, operational lagi saat WO non-kritical selesai).
 * Satu-satunya jalur manual: decommissioned via endpoint update biasa —
 * pengaktifan kembali aset dekomisi juga lewat jalur itu (keputusan admin,
 * bukan gerbang WO).
 */
class MaintenanceAsset extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_OPERATIONAL = 'operational';

    public const STATUS_UNDER_REPAIR = 'under_repair';

    public const STATUS_DECOMMISSIONED = 'decommissioned';

    protected $fillable = [
        'asset_code',
        'asset_name',
        'location',
        'ward_id',
        'status',
    ];

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function workOrders(): HasMany
    {
        return $this->hasMany(MaintenanceWorkOrder::class, 'asset_id');
    }

    protected static function newFactory(): MaintenanceAssetFactory
    {
        return MaintenanceAssetFactory::new();
    }
}
