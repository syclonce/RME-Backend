<?php

namespace Modules\InventoryDietOrder\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\InventoryDietOrder\Database\Factories\DietOrderFactory;
use Modules\PendaftaranVisit\Models\Visit;

/**
 * Pesanan diet dapur gizi per kunjungan. Status HANYA berubah lewat
 * Modules\InventoryDietOrder\Services\DietOrderService::transitionStatus()
 * (state machine ordered -> prepared -> delivered, atau cancelled dari
 * ordered/prepared) — bukan tulisan langsung dari controller.
 */
class DietOrder extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const DIET_TYPES = ['biasa', 'lunak', 'cair', 'DM', 'rendah_garam'];

    public const MEAL_SCHEDULES = ['pagi', 'siang', 'malam', 'snack'];

    public const STATUS_ORDERED = 'ordered';

    public const STATUS_PREPARED = 'prepared';

    public const STATUS_DELIVERED = 'delivered';

    public const STATUS_CANCELLED = 'cancelled';

    public const STATUSES = [
        self::STATUS_ORDERED,
        self::STATUS_PREPARED,
        self::STATUS_DELIVERED,
        self::STATUS_CANCELLED,
    ];

    protected $fillable = [
        'visit_id',
        'diet_type',
        'calorie_target',
        'allergy_notes',
        'meal_schedule',
        'ordered_by',
        'status',
        'order_date',
    ];

    protected function casts(): array
    {
        return [
            'calorie_target' => 'integer',
            'order_date' => 'date',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function orderedByEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'ordered_by');
    }

    protected static function newFactory(): DietOrderFactory
    {
        return DietOrderFactory::new();
    }
}
