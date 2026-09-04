<?php

namespace Modules\GeneralPatientIdentityCard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralIdentityCardType\Models\IdentityCardType;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientIdentityCard\Database\Factories\PatientIdentityCardFactory;

class PatientIdentityCard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'patient_id',
        'identity_card_type_id',
        'identity_number',
        'address',
        'rt',
        'rw',
        'postal_code',
        'village_id',
        'is_same_as_current_address',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_same_as_current_address' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function identityCardType(): BelongsTo
    {
        return $this->belongsTo(IdentityCardType::class, 'identity_card_type_id');
    }

    protected static function newFactory(): PatientIdentityCardFactory
    {
        return PatientIdentityCardFactory::new();
    }
}
