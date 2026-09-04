<?php

namespace Modules\GeneralPatientFamily\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientFamily\Database\Factories\PatientFamilyFactory;

class PatientFamily extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'patient_id',
        'name',
        'relationship',
        'is_active',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    protected static function newFactory(): PatientFamilyFactory
    {
        return PatientFamilyFactory::new();
    }
}
