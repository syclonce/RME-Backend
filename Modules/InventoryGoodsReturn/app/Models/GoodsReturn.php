<?php

namespace Modules\InventoryGoodsReturn\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReturn\Database\Factories\GoodsReturnFactory;
use Modules\InventorySupplier\Models\Supplier;

class GoodsReturn extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'return_number',
        'supplier_id',
        'returned_by',
        'returned_at',
        'reason',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'returned_at' => 'datetime',
        ];
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function returnedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'returned_by');
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateReturnNumber(): string
    {
        return NumberSequence::format('RTN', 'goods_return', now()->format('Y'));
    }

    protected static function newFactory(): GoodsReturnFactory
    {
        return GoodsReturnFactory::new();
    }
}
