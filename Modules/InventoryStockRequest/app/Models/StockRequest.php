<?php

namespace Modules\InventoryStockRequest\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryStockRequest\Database\Factories\StockRequestFactory;

class StockRequest extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'request_number',
        'ward_id',
        'item_id',
        'quantity',
        'requested_by',
        'requested_at',
        'fulfilled_at',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
            'fulfilled_at' => 'datetime',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateRequestNumber(): string
    {
        return NumberSequence::format('REQ', 'stock_request', now()->format('Y'));
    }

    protected static function newFactory(): StockRequestFactory
    {
        return StockRequestFactory::new();
    }
}
