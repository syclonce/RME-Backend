<?php

namespace Modules\LayananLabAnalyzerOrder\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\LayananLabAnalyzerOrder\Database\Factories\LabAnalyzerOrderFactory;
use Modules\PendaftaranVisit\Models\Visit;

class LabAnalyzerOrder extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_ORDERED = 'ordered';

    public const STATUS_SENT_TO_ANALYZER = 'sent_to_analyzer';

    public const STATUS_RESULT_RECEIVED = 'result_received';

    public const STATUS_VERIFIED = 'verified';

    /**
     * 'status' sengaja TIDAK fillable: transisi status hanya boleh lewat
     * LabAnalyzerOrderService (sendToAnalyzer/recordResult/verify). Kalau klien
     * bisa suntik status bebas lewat create/update, seluruh gerbang state
     * machine - termasuk gerbang verifikasi - bisa dilewati.
     */
    protected $fillable = [
        'visit_id',
        'vendor_id',
        'test_code',
        'ordered_by',
        'ordered_at',
        'raw_result_text',
        'verified_by',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'ordered_at' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(LabAnalyzerVendor::class, 'vendor_id');
    }

    public function orderedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'ordered_by');
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'verified_by');
    }

    protected static function newFactory(): LabAnalyzerOrderFactory
    {
        return LabAnalyzerOrderFactory::new();
    }
}
