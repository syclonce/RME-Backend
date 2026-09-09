<?php

namespace Modules\PembatalanFinalResult\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\PembatalanFinalResult\Models\FinalResult;

/**
 * Port `pembatalan_final_hasil` simgos2.
 *
 * Legacy (db/new/pembatalan/triggers/pembatalan_final_hasil_after_insert.sql):
 *
 *     AFTER INSERT ON pembatalan_final_hasil
 *       UPDATE pendaftaran.kunjungan k SET k.FINAL_HASIL = 0
 *        WHERE k.NOMOR = NEW.KUNJUNGAN;
 *
 * Artinya: mencatat pembatalan final hasil ITU SENDIRI yang membuka kembali
 * rekam medis. Tidak ada persetujuan, tidak ada status antara -- tabel legacy
 * `pembatalan_final_hasil` bahkan tidak punya kolom STATUS sama sekali.
 *
 * Sebelumnya modul ini hanya menyimpan barisnya: petugas bisa mencatat
 * pembatalan, melihatnya "approved", dan rekam medis TETAP terkunci. Catatan
 * yang tidak berefek lebih berbahaya daripada tidak ada catatan, karena
 * tampak seolah pekerjaannya sudah selesai.
 *
 * Dua hal yang sengaja dibuat lebih ketat dari legacy:
 *
 * 1. Legacy membuka kunci lewat trigger tanpa jejak siapa/kenapa di sisi
 *    kunjungan. Di sini pembukaan lewat MedicalRecordGate::beginAmendment,
 *    yang menaikkan versi RME dan mencatat transisinya -- syarat rekam medis
 *    elektronik yang dapat diaudit.
 * 2. Legacy membiarkan pembatalan diinsert berkali-kali untuk kunjungan yang
 *    sama; tiap insert menembakkan trigger lagi. Di sini pembatalan pada RME
 *    yang memang sudah terbuka ditolak, supaya versi RME tidak naik tanpa
 *    ada yang benar-benar dibatalkan.
 */
class FinalResultCancellationService
{
    public function __construct(protected MedicalRecordGate $medicalRecords) {}

    /**
     * Catat pembatalan final hasil DAN buka kembali RME kunjungan terkait.
     *
     * @param  array{visit_id:int,reason:string,cancellation_date:mixed,requested_by:string}  $data
     */
    public function cancel(array $data, User $user): FinalResult
    {
        $visitId = (int) $data['visit_id'];

        // Hanya RME yang sudah final yang punya sesuatu untuk dibatalkan.
        // Pesannya menyebut status sekarang supaya petugas tahu apa yang
        // terjadi, bukan sekadar ditolak.
        $status = $this->medicalRecords->status($visitId);
        abort_if(
            $status === null,
            422,
            'RME kunjungan ini belum pernah dibuka, jadi tidak ada final hasil yang dapat dibatalkan.',
        );
        abort_unless(
            $status === 'finalized',
            422,
            "Final hasil hanya dapat dibatalkan pada RME yang sudah final. Status RME saat ini: {$status}.",
        );

        return DB::transaction(function () use ($data, $user, $visitId) {
            $cancellation = FinalResult::create([
                ...$data,
                'cancellation_number' => FinalResult::generateCancellationNumber(),
                'status' => FinalResult::STATUS_APPLIED,
            ]);

            // Inilah padanan `SET FINAL_HASIL = 0` legacy. Berada di dalam
            // transaksi yang sama dengan catatannya: tidak mungkin ada catatan
            // pembatalan tanpa RME terbuka, atau sebaliknya.
            $this->medicalRecords->beginAmendment($visitId, $user, $data['reason']);

            return $cancellation->refresh();
        });
    }
}
