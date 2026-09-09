<?php

namespace Modules\LayananLabResult\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananLabResult\Models\LabResult;

/**
 * State machine hasil laboratorium.
 *
 * Nilai statusnya tidak pernah didaftarkan di FormRequest maupun konstanta model —
 * hanya `default('final')` di migrasi. Nilai yang benar-benar dipakai di kode
 * (`final`, `completed`, `cancelled`) dipungut dari pemakaian nyata, bukan dikarang.
 *
 * Pola mengikuti `LabOrderService`: TRANSITIONS eksplisit, `lockForUpdate`, dan
 * pengecekan status ganda (sebelum dan sesudah lock) agar dua permintaan serentak
 * tidak sama-sama lolos.
 */
class LabResultService
{
    /**
     * Hasil lahir `final` (itulah default kolomnya — hasil dicatat setelah
     * pemeriksaan selesai, bukan sebagai draf). Dari sana ia hanya dapat
     * ditutup sebagai `completed` atau dibatalkan.
     *
     * `cancelled` dan `completed` terminal: hasil laboratorium yang sudah
     * ditutup tidak boleh dihidupkan kembali — koreksi harus lewat hasil baru
     * supaya jejak nilai lama tidak hilang.
     */
    private const TRANSITIONS = [
        'final' => ['completed', 'cancelled'],
        'completed' => [],
        'cancelled' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    public function transition(LabResult $result, string $target, User $user): LabResult
    {
        $visitId = $result->labOrder?->visit_id;

        if ($visitId !== null) {
            $this->medicalRecordGate->assertWritable((int) $visitId, $user);
        }

        $allowed = self::TRANSITIONS[$result->status] ?? [];
        abort_unless(
            in_array($target, $allowed, true),
            422,
            "Transisi hasil lab {$result->status} → {$target} tidak diizinkan.",
        );

        return DB::transaction(function () use ($result, $target) {
            $locked = LabResult::query()->whereKey($result->id)->lockForUpdate()->firstOrFail();

            abort_unless(
                in_array($target, self::TRANSITIONS[$locked->status] ?? [], true),
                422,
                'Status hasil lab sudah berubah.',
            );

            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
