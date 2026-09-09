<?php

namespace Modules\GeneralAmbulanceFleet\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\GeneralAmbulanceFleet\Database\Factories\AmbulanceFactory;

/**
 * State machine armada ambulans. Perubahan status HANYA lewat
 * Modules\GeneralAmbulanceFleet\Services\AmbulanceTripService (mulai/selesai
 * trip) - bukan tulisan langsung dari controller.
 */
class Ambulance extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_AVAILABLE = 'available';

    public const STATUS_IN_USE = 'in_use';

    public const STATUS_MAINTENANCE = 'maintenance';

    protected $fillable = [
        'vehicle_code',
        'plate_number',
        'status',
    ];

    public function trips(): HasMany
    {
        return $this->hasMany(AmbulanceTrip::class);
    }

    protected static function newFactory(): AmbulanceFactory
    {
        return AmbulanceFactory::new();
    }
}
