<?php

namespace Modules\GeneralPatientPhoto\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralPatientPhoto\Database\Factories\PatientPhotoFactory;

class PatientPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'file_path', 'taken_at'];

    protected $appends = ['photo_url'];

    protected function casts(): array
    {
        return ['taken_at' => 'datetime'];
    }

    protected function photoUrl(): Attribute
    {
        return Attribute::get(fn () => $this->file_path ? Storage::disk('public')->url($this->file_path) : null);
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    protected static function newFactory(): PatientPhotoFactory
    {
        return PatientPhotoFactory::new();
    }
}
