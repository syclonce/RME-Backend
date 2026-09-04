<?php

namespace Modules\PembayaranDeposit\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\Auth\Models\User;
use Modules\PembayaranDeposit\Database\Factories\DepositFactory;
use Modules\PendaftaranVisit\Models\Visit;

class Deposit extends Model
{
    use Auditable, HasFactory, HydratesDatabaseDefaults;

    /**
     * Plafon wajar satu kali setoran deposit tunai per kunjungan. Melampauinya
     * hanya lewat persetujuan admin -- mencegah deposit fiktif berukuran
     * raksasa dipakai untuk menggembungkan batas refund kumulatif.
     */
    public const MAX_AMOUNT = 100000000;

    protected $fillable = [
        'deposit_number',
        'visit_id',
        'amount',
        'paid_at',
        'received_by',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
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
    public static function generateDepositNumber(): string
    {
        return NumberSequence::format('DEP', 'deposit', now()->format('Y'));
    }

    protected static function newFactory(): DepositFactory
    {
        return DepositFactory::new();
    }
}
