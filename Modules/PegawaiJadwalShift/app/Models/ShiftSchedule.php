<?php

namespace Modules\PegawaiJadwalShift\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralStaffMember\Models\StaffMember;
use Modules\GeneralWard\Models\Ward;
use Modules\PegawaiJadwalShift\Database\Factories\ShiftScheduleFactory;

/**
 * Jadwal shift kerja perawat/staf. Pemilik jadwal adalah staff_member_id ATAU
 * employee_id (salah satu, tidak keduanya) — gerbangnya ada di
 * ShiftScheduleService, bukan di model ini.
 */
class ShiftSchedule extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const SHIFT_PAGI = 'pagi';

    public const SHIFT_SIANG = 'siang';

    public const SHIFT_MALAM = 'malam';

    public const STATUS_SCHEDULED = 'scheduled';

    public const STATUS_CONFIRMED = 'confirmed';

    public const STATUS_ABSENT = 'absent';

    protected $fillable = [
        'staff_member_id',
        'employee_id',
        'ward_id',
        'shift_type',
        'shift_date',
        'start_time',
        'end_time',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'shift_date' => 'date:Y-m-d',
        ];
    }

    public function staffMember(): BelongsTo
    {
        return $this->belongsTo(StaffMember::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    protected static function newFactory(): ShiftScheduleFactory
    {
        return ShiftScheduleFactory::new();
    }
}
