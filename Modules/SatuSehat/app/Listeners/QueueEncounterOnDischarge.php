<?php

namespace Modules\SatuSehat\Listeners;

use App\Events\VisitDischarged;
use Modules\SatuSehat\Services\SatuSehatOutboxService;

/**
 * Antrekan FHIR Encounter saat pasien pulang.
 *
 * Dipilih `VisitDischarged`, bukan `VisitAdmitted`, karena Encounter SATUSEHAT
 * baru lengkap setelah kunjungan selesai: periode (masuk–pulang) dan hasil akhir
 * pelayanan baru pasti pada saat itu. Mengirim saat masuk berarti hampir setiap
 * Encounter harus diperbarui lagi kemudian.
 *
 * Listener ini hanya MENGANTREKAN. Pengiriman ke SATUSEHAT dilakukan worker
 * terpisah — itulah inti pola outbox: kegagalan jaringan tidak boleh membatalkan
 * transaksi klinis yang sudah sah, dan tidak boleh membuat petugas menunggu.
 * Legacy melakukan sebaliknya (sinkron di dalam request), dan akibatnya terlihat:
 * kegagalan tersimpan sebagai teks tanpa jalur pemulihan.
 */
class QueueEncounterOnDischarge
{
    public function __construct(protected SatuSehatOutboxService $outbox) {}

    public function handle(VisitDischarged $event): void
    {
        $visit = $event->visit;

        // Kunjungan batal tidak pernah terjadi secara klinis — tidak ada yang
        // perlu dilaporkan ke SATUSEHAT.
        if ($visit->status === 'cancelled') {
            return;
        }

        // Payload sengaja minimal dan memakai ID internal. Pemetaan penuh ke
        // struktur FHIR (termasuk penukaran ID pasien/praktisi menjadi IHS ID)
        // adalah tugas worker pengirim, yang punya akses ke klien SATUSEHAT dan
        // dapat menangani kegagalan pemetaan sebagai kegagalan kiriman —
        // bukan sebagai kegagalan proses pemulangan pasien.
        $this->outbox->enqueue('Encounter', $visit, [
            'visit_id' => $visit->id,
            'registration_id' => $visit->registration_id,
            'ward_id' => $visit->ward_id,
            'admitted_at' => optional($visit->admitted_at)->toIso8601String(),
            'discharged_at' => optional($visit->discharged_at)->toIso8601String(),
            'final_outcome' => $visit->final_outcome,
        ]);
    }
}
