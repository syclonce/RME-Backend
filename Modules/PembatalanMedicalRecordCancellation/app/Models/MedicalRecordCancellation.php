<?php
namespace Modules\PembatalanMedicalRecordCancellation\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class MedicalRecordCancellation extends Model {
    use HasFactory, HydratesDatabaseDefaults;
    protected $fillable = ['medical_record_id', 'cancellation_number', 'reason', 'cancellation_date', 'requested_by', 'status'];
    protected $casts = ['cancellation_date' => 'datetime'];
    public static function generateCancellationNumber(): string {
        return NumberSequence::format('MRC', 'medical_record_cancellation', now()->format('Y'));
    }
    protected static function newFactory() {
        return \Modules\PembatalanMedicalRecordCancellation\Database\Factories\MedicalRecordCancellationFactory::new();
    }
}
