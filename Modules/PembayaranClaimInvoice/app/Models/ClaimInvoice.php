<?php

namespace Modules\PembayaranClaimInvoice\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\PembayaranClaimInvoice\Database\Factories\ClaimInvoiceFactory;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PendaftaranGuarantor\Models\Guarantor;

class ClaimInvoice extends Model
{
    use Auditable, HasFactory, HydratesDatabaseDefaults;

    public const STATUSES = ['draft', 'submitted', 'verified', 'paid', 'rejected'];

    protected $fillable = [
        'claim_number',
        'invoice_id',
        'guarantor_id',
        'claim_amount',
        'verified_amount',
        'submitted_at',
        'status',
        'rejection_reason',
    ];

    protected function casts(): array
    {
        return [
            'claim_amount' => 'decimal:2',
            'verified_amount' => 'decimal:2',
            'submitted_at' => 'datetime',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function guarantor(): BelongsTo
    {
        return $this->belongsTo(Guarantor::class);
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateClaimNumber(): string
    {
        return NumberSequence::format('CLM', 'claim_invoice', now()->format('Y'));
    }

    protected static function newFactory(): ClaimInvoiceFactory
    {
        return ClaimInvoiceFactory::new();
    }
}
