<?php

namespace Modules\InventoryGoodsReceiptCancellation\Models;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\InventoryGoodsReceipt\Models\GoodsReceipt;
use Modules\InventoryGoodsReceiptCancellation\Database\Factories\GoodsReceiptCancellationFactory;

class GoodsReceiptCancellation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cancellation_number',
        'goods_receipt_id',
        'reason',
        'cancelled_by',
        'cancelled_at',
    ];

    protected function casts(): array
    {
        return [
            'cancelled_at' => 'datetime',
        ];
    }

    public function goodsReceipt(): BelongsTo
    {
        return $this->belongsTo(GoodsReceipt::class);
    }

    public function cancelledBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }
    public static function generateCancellationNumber(): string
    {
        return NumberSequence::format('GRC', 'goods_receipt_cancellation', now()->format('Y'));
    }

    protected static function newFactory(): GoodsReceiptCancellationFactory
    {
        return GoodsReceiptCancellationFactory::new();
    }
}
