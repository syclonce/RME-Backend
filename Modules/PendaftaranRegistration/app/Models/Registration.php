<?php

namespace Modules\PendaftaranRegistration\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Auth\Models\User;
use Modules\GeneralDiagnosisCode\Models\DiagnosisCode;
use Modules\GeneralPackage\Models\Package;
use Modules\GeneralPatient\Models\Patient;
use Modules\PendaftaranReferral\Models\Referral;
use Modules\PendaftaranRegistration\Database\Factories\RegistrationFactory;
use Modules\PendaftaranVisit\Models\Visit;

class Registration extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'registration_number',
        'patient_id',
        'registered_at',
        'admission_diagnosis_id',
        'referral_id',
        'package_id',
        'is_emergency',
        'has_fall_risk',
        'newborn_weight_grams',
        'newborn_length_cm',
        'birth_time',
        'found_location',
        'found_at',
        'satu_sehat_consent',
        'registered_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'registered_at' => 'datetime',
            'is_emergency' => 'boolean',
            'has_fall_risk' => 'boolean',
            'found_at' => 'datetime',
            'satu_sehat_consent' => 'boolean',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function admissionDiagnosis(): BelongsTo
    {
        return $this->belongsTo(DiagnosisCode::class, 'admission_diagnosis_id');
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Referral::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Bacaan saja — kepemilikan kunjungan tetap di Modules\PendaftaranVisit
     * (lihat docs-sim/KONTRAK-LINTAS-DOMAIN.md). Dipakai untuk mencegah
     * destroy() pendaftaran yang sudah punya kunjungan (cascade delete).
     */
    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateRegistrationNumber(): string
    {
        return NumberSequence::format('REG', 'registration', now()->format('Y'));
    }

    protected static function newFactory(): RegistrationFactory
    {
        return RegistrationFactory::new();
    }
}
