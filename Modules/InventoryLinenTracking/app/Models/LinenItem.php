<?php

namespace Modules\InventoryLinenTracking\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryLinenTracking\Database\Factories\LinenItemFactory;

/**
 * Master linen (sprei, selimut, baju OK, dsb). ward_id nullable karena
 * sebagian item linen adalah stok umum (mis. gudang pusat), tidak selalu
 * ditugaskan ke ward tertentu.
 */
class LinenItem extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $fillable = ['linen_code', 'linen_type', 'ward_id'];

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function cycles(): HasMany
    {
        return $this->hasMany(LinenCycle::class);
    }

    protected static function newFactory(): LinenItemFactory
    {
        return LinenItemFactory::new();
    }
}
