<?php

namespace Modules\GeneralPatient\Models;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravolt\Indonesia\Models\Village;
use Modules\Auth\Models\User;
use Modules\GeneralCountry\Models\Country;
use Modules\GeneralEducation\Models\Education;
use Modules\GeneralEthnicity\Models\Ethnicity;
use Modules\GeneralGender\Models\Gender;
use Modules\GeneralLanguage\Models\Language;
use Modules\GeneralMaritalStatus\Models\MaritalStatus;
use Modules\GeneralOccupation\Models\Occupation;
use Modules\GeneralPatient\Database\Factories\PatientFactory;
use Modules\GeneralPatientContact\Models\PatientContact;
use Modules\GeneralPatientFamily\Models\PatientFamily;
use Modules\GeneralPatientPhoto\Models\PatientPhoto;
use Modules\GeneralPatientStatus\Models\PatientStatus;
use Modules\GeneralPatientType\Models\PatientType;
use Modules\GeneralReligion\Models\Religion;
use Modules\KemkesBloodType\Models\BloodType;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_number',
        'nik',
        'no_bpjs',
        'name',
        'nickname',
        'title_prefix',
        'title_suffix',
        'birth_place',
        'birth_date',
        'gender_id',
        'religion_id',
        'address',
        'rt',
        'rw',
        'postal_code',
        'village_id',
        'education_id',
        'occupation_id',
        'marital_status_id',
        'blood_type_id',
        'nationality_id',
        'ethnicity_id',
        'language_id',
        'is_unidentified',
        'patient_status_id',
        'patient_type_id',
        'registered_by',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
            'is_unidentified' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function religion(): BelongsTo
    {
        return $this->belongsTo(Religion::class);
    }

    public function village(): BelongsTo
    {
        return $this->belongsTo(Village::class);
    }

    public function registeredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function education(): BelongsTo
    {
        return $this->belongsTo(Education::class);
    }

    public function occupation(): BelongsTo
    {
        return $this->belongsTo(Occupation::class);
    }

    public function maritalStatus(): BelongsTo
    {
        return $this->belongsTo(MaritalStatus::class);
    }

    public function bloodType(): BelongsTo
    {
        return $this->belongsTo(BloodType::class);
    }

    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function ethnicity(): BelongsTo
    {
        return $this->belongsTo(Ethnicity::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function patientStatus(): BelongsTo
    {
        return $this->belongsTo(PatientStatus::class);
    }

    public function patientType(): BelongsTo
    {
        return $this->belongsTo(PatientType::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(PatientContact::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(PatientPhoto::class);
    }

    public function families(): HasMany
    {
        return $this->hasMany(PatientFamily::class);
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateMedicalRecordNumber(): string
    {
        return NumberSequence::format('RM', 'medical_record_number', now()->format('Y'));
    }

    /**
     * Candidate matches for the "cari pasien sudah pernah terdaftar" step
     * (Alur 1001) before staff create a new patient record. NIK match is
     * exact (it's a unique identifier); name+birth_date is a fuzzy fallback
     * for cases where NIK wasn't captured or was entered inconsistently.
     */
    public static function searchDuplicates(?string $nik, ?string $name, ?string $birthDate): \Illuminate\Database\Eloquent\Collection
    {
        return static::query()
            ->where(function ($query) use ($nik, $name, $birthDate) {
                if (filled($nik)) {
                    $query->orWhere('nik', $nik);
                }

                if (filled($name)) {
                    $query->orWhere(function ($nameQuery) use ($name, $birthDate) {
                        $nameQuery->where('name', 'like', "%{$name}%");

                        if (filled($birthDate)) {
                            $nameQuery->where('birth_date', $birthDate);
                        }
                    });
                }
            })
            ->limit(20)
            ->get();
    }

    protected static function newFactory(): PatientFactory
    {
        return PatientFactory::new();
    }
}
