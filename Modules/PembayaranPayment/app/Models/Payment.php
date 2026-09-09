<?php

namespace Modules\PembayaranPayment\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranPayment\Database\Factories\PaymentFactory;

class Payment extends Model
{
    use Auditable, HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'payment_number',
        'idempotency_key',
        'invoice_id',
        'cashier_shift_id',
        'payment_method',
        'amount',
        'admin_fee',
        'paid_at',
        'received_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'admin_fee' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
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
    public static function generatePaymentNumber(): string
    {
        return NumberSequence::format('PAY', 'payment', now()->format('Y'));
    }

    protected static function newFactory(): PaymentFactory
    {
        return PaymentFactory::new();
    }
}
