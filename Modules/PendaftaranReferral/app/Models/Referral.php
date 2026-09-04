<?php

namespace Modules\PendaftaranReferral\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranReferral\Database\Factories\ReferralFactory;

class Referral extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'referral_number',
        'patient_id',
        'direction',
        'facility_name',
        'reason',
        'referred_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'referred_at' => 'datetime',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateReferralNumber(): string
    {
        return NumberSequence::format('RUJ', 'referral', now()->format('Y'));
    }

    protected static function newFactory(): ReferralFactory
    {
        return ReferralFactory::new();
    }
}
