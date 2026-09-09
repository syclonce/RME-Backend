<?php

namespace Modules\PembayaranCashierTransaction\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\PembayaranCashier\Models\Cashier;
use Modules\PembayaranCashierTransaction\Database\Factories\CashierTransactionFactory;
use Modules\PembayaranInvoice\Models\Invoice;

class CashierTransaction extends Model
{
    use Auditable, HasFactory;

    public const TRANSACTION_TYPES = ['in', 'out'];

    protected $fillable = [
        'cashier_id',
        'cashier_shift_id',
        'invoice_id',
        'amount',
        'transaction_type',
        'transacted_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'transacted_at' => 'datetime',
        ];
    }

    public function cashier(): BelongsTo
    {
        return $this->belongsTo(Cashier::class);
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    protected static function newFactory(): CashierTransactionFactory
    {
        return CashierTransactionFactory::new();
    }
}
