<?php

namespace App\Modules\Contracts;

/**
 * Kontrak gerbang status kunjungan lintas modul.
 *
 * Ala simgos2: sebelum posting layanan (tindakan, resep, lab), pemeriksa
 * harus yakin pasien belum pulang (blokir "pasien sudah pulang") dan
 * kunjungan benar-benar aktif.
 *
 * Implementasi: Modules\PendaftaranVisit\App\Services\VisitService.
 */
interface VisitGate
{
    /**
     * Apakah registrasi/kunjungan ini sudah berstatus pulang (discharge)?
     */
    public function isPatientDischarged(int $visitId): bool;

    /**
     * Apakah kunjungan sedang aktif (belum pulang dan tidak batal)?
     */
    public function isActive(int $visitId): bool;

    /** Kunjungan ada dan tidak batal; boleh difinalkan walau sudah pulang. */
    public function canFinalizeMedicalRecord(int $visitId): bool;
}
