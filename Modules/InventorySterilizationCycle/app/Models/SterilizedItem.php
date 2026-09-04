<?php

namespace Modules\InventorySterilizationCycle\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventorySterilizationCycle\Database\Factories\SterilizedItemFactory;

/**
 * Item hasil satu siklus sterilisasi. expiry_date dihitung sekali saat
 * dibuat (completed_at cycle + shelf_life dari HospitalConfig
 * 'cssd.default_shelf_life_days') — lihat SterilizedItemService::createItem().
 */
class SterilizedItem extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'cycle_id',
        'item_name',
        'quantity',
        'expiry_date',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'expiry_date' => 'date',
        ];
    }

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(SterilizationCycle::class, 'cycle_id');
    }

    protected static function newFactory(): SterilizedItemFactory
    {
        return SterilizedItemFactory::new();
    }
}
