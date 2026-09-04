<?php

namespace Modules\PembayaranInvoiceMerge\Models;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceMerge\Database\Factories\InvoiceMergeFactory;
use Modules\PembayaranPayment\Models\Payment;

class InvoiceMerge extends Model
{
    use HasFactory;

    protected $fillable = [
        'merge_number',
        'payment_id',
        'invoice_id',
        'allocated_amount',
        'merged_by',
        'merged_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'allocated_amount' => 'decimal:2',
            'merged_at' => 'datetime',
        ];
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function mergedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'merged_by');
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateMergeNumber(): string
    {
        return NumberSequence::format('MRG', 'invoice_merge', now()->format('Y'));
    }

    protected static function newFactory(): InvoiceMergeFactory
    {
        return InvoiceMergeFactory::new();
    }
}
