<?php

namespace Modules\GeneralPatientFamilyContact\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatientFamily\Models\PatientFamily;
use Modules\GeneralPatientFamilyContact\Database\Factories\PatientFamilyContactFactory;

class PatientFamilyContact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'patient_family_id',
        'contact_type',
        'contact_value',
        'is_active',
    ];

    public function patientFamily(): BelongsTo
    {
        return $this->belongsTo(PatientFamily::class);
    }

    protected static function newFactory(): PatientFamilyContactFactory
    {
        return PatientFamilyContactFactory::new();
    }
}
