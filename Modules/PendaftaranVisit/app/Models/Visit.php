<?php

namespace Modules\PendaftaranVisit\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\Auth\Models\User;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralRoomClass\Models\RoomClass;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Database\Factories\VisitFactory;

class Visit extends Model
{
    use Auditable, HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'visit_number',
        'registration_id',
        'origin_type',
        'origin_id',
        'attending_physician_id',
        'ward_id',
        'bed_id',
        'admitted_at',
        'discharged_at',
        'is_new_visit',
        'is_deposit',
        'deposit_class_id',
        'received_by',
        'final_outcome',
        'final_outcome_by',
        'final_outcome_at',
        'service_finalized_at',
        'service_finalized_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'admitted_at' => 'datetime',
            'discharged_at' => 'datetime',
            'is_new_visit' => 'boolean',
            'is_deposit' => 'boolean',
            'final_outcome_at' => 'datetime',
            'service_finalized_at' => 'datetime',
        ];
    }

    /**
     * Transaksi yang menerbitkan kunjungan ini — padanan `kunjungan.REF` legacy.
     *
     * NULL berarti kunjungan lahir langsung dari pendaftaran (mayoritas rawat
     * jalan). Terisi bila kunjungan ini turunan: konsul, mutasi, order lab,
     * order radiologi, atau resep. Tanpa tautan ini unit penunjang tahu ia
     * melayani pasien, tetapi tidak tahu atas permintaan siapa.
     */
    public function origin(): MorphTo
    {
        return $this->morphTo();
    }

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function attendingPhysician(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'attending_physician_id');
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function bed(): BelongsTo
    {
        return $this->belongsTo(Bed::class);
    }

    public function depositClass(): BelongsTo
    {
        return $this->belongsTo(RoomClass::class, 'deposit_class_id');
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function finalOutcomeBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'final_outcome_by');
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateVisitNumber(): string
    {
        return NumberSequence::format('KJ', 'visit', now()->format('Y'));
    }

    protected static function newFactory(): VisitFactory
    {
        return VisitFactory::new();
    }
}
