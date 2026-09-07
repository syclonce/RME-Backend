<?php

namespace Modules\MedicalRecordCppt\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordCppt\Database\Factories\CpptEntryFactory;
use Modules\PendaftaranVisit\Models\Visit;

class CpptEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'recorded_at',
        'subjective',
        'objective',
        'assessment',
        'plan',
        'instruction',
        'profession',
        'recorded_by',
    ];

    protected function casts(): array
    {
        return [
            'recorded_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'recorded_by');
    }

    protected static function newFactory(): CpptEntryFactory
    {
        return CpptEntryFactory::new();
    }
}
