<?php

namespace Modules\InventoryBloodBag\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralPatient\Models\Patient;
use Modules\InventoryBloodBag\Database\Factories\CrossmatchTestFactory;

class CrossmatchTest extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const RESULT_POSITIVE = 'pos';

    public const RESULT_NEGATIVE = 'neg';

    protected $fillable = [
        'blood_bag_id',
        'patient_id',
        'major_result',
        'minor_result',
        'auto_control',
        'is_compatible',
        'tested_by',
        'tested_at',
        'reserved_until',
    ];

    protected function casts(): array
    {
        return [
            'is_compatible' => 'boolean',
            'tested_at' => 'datetime',
            'reserved_until' => 'datetime',
        ];
    }

    public function bloodBag(): BelongsTo
    {
        return $this->belongsTo(BloodBag::class);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function testedByEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'tested_by');
    }

    /**
     * Kompatibel hanya bila mayor, minor, DAN auto control ketiganya negatif
     * (tidak ada aglutinasi). Auto control positif berarti tes tidak valid
     * (reaksi non-spesifik), jadi ikut menggagalkan kompatibilitas.
     */
    public static function computeIsCompatible(string $majorResult, string $minorResult, string $autoControl): bool
    {
        return $majorResult === self::RESULT_NEGATIVE
            && $minorResult === self::RESULT_NEGATIVE
            && $autoControl === self::RESULT_NEGATIVE;
    }

    protected static function newFactory(): CrossmatchTestFactory
    {
        return CrossmatchTestFactory::new();
    }
}
