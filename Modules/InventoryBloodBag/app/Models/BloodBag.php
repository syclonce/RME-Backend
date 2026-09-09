<?php

namespace Modules\InventoryBloodBag\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\InventoryBloodBag\Database\Factories\BloodBagFactory;
use Modules\KemkesBloodType\Models\BloodType;

/**
 * State machine kantong darah BDRS. Perubahan status HANYA lewat
 * Modules\InventoryBloodBag\Services\BloodBankService — controller tidak
 * boleh menulis status langsung (lihat catatan gerbang di service).
 */
class BloodBag extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_IN_STOCK = 'in_stock';

    public const STATUS_CROSSMATCH_RESERVED = 'crossmatch_reserved';

    public const STATUS_RELEASED = 'released';

    public const STATUS_TRANSFUSED = 'transfused';

    public const STATUS_RETURNED = 'returned';

    public const STATUS_DISCARDED_EXPIRED = 'discarded_expired';

    protected $fillable = [
        'bag_number',
        'blood_type_id',
        'volume_ml',
        'collected_at',
        'expires_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'volume_ml' => 'integer',
            'collected_at' => 'datetime',
            'expires_at' => 'datetime',
        ];
    }

    public function bloodType(): BelongsTo
    {
        return $this->belongsTo(BloodType::class);
    }

    public function crossmatchTests(): HasMany
    {
        return $this->hasMany(CrossmatchTest::class);
    }

    protected static function newFactory(): BloodBagFactory
    {
        return BloodBagFactory::new();
    }
}
