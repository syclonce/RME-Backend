<?php

namespace Modules\PendaftaranVisit\Support;

use Illuminate\Database\Eloquent\Model;
use Modules\Auth\Models\User;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisit\Services\VisitService;

/**
 * Penerbit kunjungan turunan — padanan `kunjungan.REF` legacy.
 *
 * Di SIMGOS2 tiap pengiriman antar-unit melahirkan kunjungan di unit tujuan,
 * berprefiks: 10 konsul, 11 mutasi, 12 order lab, 13 order radiologi, 14 resep
 * (peta induk Temuan 4). Tanpa itu, pelayanan unit penunjang menumpang kunjungan
 * poli pengirim sehingga tindakan dan tagihannya tidak dapat dipisahkan per unit.
 *
 * Logikanya disatukan di sini karena lab, radiologi, dan farmasi membutuhkan
 * perilaku yang persis sama — menyalinnya tiga kali berarti tiga tempat yang
 * bisa menyimpang.
 */
class DerivedVisitFactory
{
    public function __construct(protected VisitService $visitService) {}

    /**
     * Terbitkan kunjungan unit penunjang untuk sebuah transaksi.
     *
     * @param  Model  $origin       transaksi penerbit (LabOrder, RadiologyOrder, Prescription…)
     * @param  string $visitTypeCode kode `ward_visit_types` unit tujuan (referensi JENIS 15
     *                               legacy: 4=Laboratorium, 5=Radiologi, 11=Farmasi)
     * @param  int    $sourceVisitId kunjungan asal, dipakai mencari pendaftarannya
     *
     * @return Visit|null null bila dilewati — lihat alasan di bawah
     */
    public function create(Model $origin, string $visitTypeCode, int $sourceVisitId, User $user): ?Visit
    {
        // Idempoten: transisi status dapat berulang (order dibatalkan lalu
        // dijalankan lagi), dan satu order hanya boleh punya satu kunjungan.
        $exists = Visit::query()
            ->where('origin_type', $origin::class)
            ->where('origin_id', $origin->getKey())
            ->exists();

        if ($exists) {
            return null;
        }

        $wardId = Ward::query()
            ->whereHas('visitType', fn ($q) => $q->where('code', $visitTypeCode))
            ->value('id');

        // Dilewati diam-diam bila unit belum punya ruangan terdaftar. Menghentikan
        // pemeriksaan atau penyerahan obat karena data ruangan belum lengkap tidak
        // sepadan — yang hilang hanya kunjungan turunannya, bukan pelayanannya.
        if ($wardId === null) {
            return null;
        }

        $registrationId = Visit::query()->whereKey($sourceVisitId)->value('registration_id');

        if ($registrationId === null) {
            return null;
        }

        return $this->visitService->admit([
            'registration_id' => $registrationId,
            'ward_id' => $wardId,
            'admitted_at' => now(),
            'origin_type' => $origin::class,
            'origin_id' => $origin->getKey(),
        ], $user);
    }
}
