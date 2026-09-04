<?php

namespace Modules\LayananPatientComplaint\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\LayananPatientComplaint\Database\Factories\PatientSurveyFactory;
use Modules\PendaftaranVisit\Models\Visit;

class PatientSurvey extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $table = 'patient_surveys';

    protected $fillable = [
        'visit_id',
        'satisfaction_score',
        'feedback_text',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'satisfaction_score' => 'integer',
            'submitted_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class, 'visit_id');
    }

    protected static function newFactory(): PatientSurveyFactory
    {
        return PatientSurveyFactory::new();
    }
}
