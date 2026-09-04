<?php

namespace Modules\InventoryGoodsReceipt\Models;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReceipt\Database\Factories\GoodsReceiptFactory;
use Modules\InventoryItem\Models\Item;
use Modules\InventorySupplier\Models\Supplier;

class GoodsReceipt extends Model
{
    use HasFactory;

    protected $fillable = [
        'receipt_number',
        'supplier_id',
        'item_id',
        'quantity',
        'unit_price',
        'received_by',
        'received_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'unit_price' => 'decimal:2',
            'received_at' => 'datetime',
        ];
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateReceiptNumber(): string
    {
        return NumberSequence::format('REC', 'goods_receipt', now()->format('Y'));
    }

    protected static function newFactory(): GoodsReceiptFactory
    {
        return GoodsReceiptFactory::new();
    }
}
