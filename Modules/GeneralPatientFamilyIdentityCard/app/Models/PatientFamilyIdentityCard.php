<?php

namespace Modules\GeneralPatientFamilyIdentityCard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatientFamily\Models\PatientFamily;
use Modules\GeneralPatientFamilyIdentityCard\Database\Factories\PatientFamilyIdentityCardFactory;

class PatientFamilyIdentityCard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'patient_family_id',
        'identity_type',
        'identity_number',
        'is_active',
    ];

    public function patientFamily(): BelongsTo
    {
        return $this->belongsTo(PatientFamily::class);
    }

    protected static function newFactory(): PatientFamilyIdentityCardFactory
    {
        return PatientFamilyIdentityCardFactory::new();
    }
}
