<?php

namespace App\Modules\Contracts;

/**
 * Kontribusi aturan finalisasi dari masing-masing bounded context.
 *
 * Implementasi hanya boleh membaca data milik modulnya sendiri. Orkestrator
 * episode RME menggabungkan seluruh pelanggaran tanpa mengakses tabel modul
 * klinis secara langsung.
 */
interface EncounterFinalizationRule
{
    /** @return list<string> */
    public function violations(int $visitId): array;
}
