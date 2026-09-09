<?php

namespace Modules\LayananMedicalProcedure\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\LayananMedicalProcedure\Models\MedicalProcedure;

/**
 * State machine tindakan medis.
 *
 * Nilai statusnya (`completed`, `cancelled`) diambil dari `Rule::in` yang sudah ada
 * di Store/UpdateMedicalProcedureRequest — bukan dikarang.
 *
 * Tindakan medis lahir langsung `completed`: berbeda dari order lab atau radiologi
 * yang dipesan lebih dulu lalu dikerjakan, tindakan dicatat SETELAH dilakukan.
 * Karena itu tidak ada status "dijadwalkan" atau "berlangsung" di sini.
 *
 * Pembatalan bersifat satu arah dan terminal. Legacy bahkan lebih ketat —
 * `TindakanMedisResource::delete` SELALU menolak 405 (peta induk Temuan 3),
 * sehingga tindakan tidak pernah bisa dihapus. Di sini pembatalan diizinkan
 * sebagai penandaan, tetapi tidak dapat dibatalkan kembali: tindakan yang sudah
 * ditandai batal lalu dihidupkan lagi akan mengaburkan apa yang benar-benar
 * dikerjakan pada pasien.
 */
class MedicalProcedureService
{
    private const TRANSITIONS = [
        'completed' => ['cancelled'],
        'cancelled' => [],
    ];

    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    public function transition(MedicalProcedure $procedure, string $target, User $user): MedicalProcedure
    {
        $this->medicalRecordGate->assertWritable((int) $procedure->visit_id, $user);

        $allowed = self::TRANSITIONS[$procedure->status] ?? [];
        abort_unless(
            in_array($target, $allowed, true),
            422,
            "Transisi tindakan medis {$procedure->status} → {$target} tidak diizinkan.",
        );

        return DB::transaction(function () use ($procedure, $target) {
            $locked = MedicalProcedure::query()->whereKey($procedure->id)->lockForUpdate()->firstOrFail();

            abort_unless(
                in_array($target, self::TRANSITIONS[$locked->status] ?? [], true),
                422,
                'Status tindakan medis sudah berubah.',
            );

            $locked->update(['status' => $target]);

            return $locked->refresh();
        });
    }
}
