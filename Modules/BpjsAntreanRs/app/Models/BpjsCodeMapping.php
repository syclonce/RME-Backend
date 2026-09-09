<?php

namespace Modules\BpjsAntreanRs\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Auth\Models\User;
use Modules\GeneralEmployee\Models\Employee;
use Modules\GeneralWard\Models\Ward;

/**
 * Pemetaan kode referensi BPJS (kodepoli/kodedokter) ke ward/employee
 * internal SIMGOS. Lihat catatan keputusan di migrasi
 * 2026_09_04_090000_create_antrean_rs_bpjs_code_mappings_table.php.
 *
 * Satu baris memetakan SALAH SATU dari ward (kodepoli) atau employee
 * (kodedokter) — tidak pernah dua-duanya sekaligus.
 */
class BpjsCodeMapping extends Model
{
    protected $table = 'antrean_rs_bpjs_code_mappings';

    protected $fillable = [
        'ward_id',
        'employee_id',
        'bpjs_code',
        'bpjs_name',
        'is_active',
        'valid_from',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'valid_from' => 'date',
        ];
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
