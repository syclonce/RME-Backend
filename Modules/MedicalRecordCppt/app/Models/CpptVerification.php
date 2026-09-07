<?php

namespace Modules\MedicalRecordCppt\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordCppt\Database\Factories\CpptVerificationFactory;
use Modules\PendaftaranVisit\Models\Visit;

class CpptVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'valid_until',
        'verified_at',
        'verified_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'valid_until' => 'date',
            'verified_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'verified_by');
    }

    protected static function newFactory(): CpptVerificationFactory
    {
        return CpptVerificationFactory::new();
    }
}
