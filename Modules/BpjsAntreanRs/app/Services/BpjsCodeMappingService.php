<?php

namespace Modules\BpjsAntreanRs\Services;

use Illuminate\Validation\ValidationException;
use Modules\BpjsAntreanRs\Models\BpjsCodeMapping;

/**
 * Penulisan pemetaan kode BPJS (kodepoli/kodedokter) selalu lewat service
 * ini, bukan Eloquent langsung dari controller — supaya dua aturan berikut
 * konsisten di semua jalur tulis (lihat catatan di migrasi tabel):
 *
 *   1. Satu baris HARUS memetakan salah satu ward_id atau employee_id
 *      (XOR), tidak boleh dua-duanya kosong atau dua-duanya terisi.
 *   2. Untuk satu ward/employee, hanya boleh ada SATU baris is_active=true
 *      pada satu waktu — draf antrean (AntreanDraftService) mengambil kode
 *      aktif tanpa ambiguitas. Mengaktifkan baris baru otomatis menonaktifkan
 *      baris aktif lama untuk target yang sama (riwayat tetap tersimpan,
 *      bukan dihapus).
 */
class BpjsCodeMappingService
{
    public function create(array $data): BpjsCodeMapping
    {
        $this->assertExactlyOneTarget($data);

        return $this->persist(new BpjsCodeMapping(), $data);
    }

    public function update(BpjsCodeMapping $mapping, array $data): BpjsCodeMapping
    {
        // ward_id/employee_id tidak diizinkan diubah lewat update biasa —
        // mengganti target sebuah baris riwayat akan merusak jejak audit.
        // Untuk memetakan ulang ward/employee ke kode lain, buat baris baru
        // (create) dan biarkan baris lama dinonaktifkan otomatis.
        unset($data['ward_id'], $data['employee_id']);

        return $this->persist($mapping, $data);
    }

    private function persist(BpjsCodeMapping $mapping, array $data): BpjsCodeMapping
    {
        $wardId = $mapping->exists ? $mapping->ward_id : ($data['ward_id'] ?? null);
        $employeeId = $mapping->exists ? $mapping->employee_id : ($data['employee_id'] ?? null);

        $makingActive = (bool) ($data['is_active'] ?? $mapping->is_active ?? true);

        if ($makingActive) {
            $this->deactivateOthers($wardId, $employeeId, $mapping->id);
        }

        $mapping->fill($data);
        $mapping->save();

        return $mapping;
    }

    /**
     * Nonaktifkan baris aktif lain untuk ward/employee yang sama, supaya
     * hanya ada satu kode aktif per target (aturan #2 di atas).
     */
    private function deactivateOthers(?int $wardId, ?int $employeeId, ?int $exceptId = null): void
    {
        $query = BpjsCodeMapping::query()->where('is_active', true);

        if ($wardId !== null) {
            $query->where('ward_id', $wardId);
        } else {
            $query->where('employee_id', $employeeId);
        }

        if ($exceptId !== null) {
            $query->where('id', '!=', $exceptId);
        }


        $query->update(['is_active' => false]);
    }

    private function assertExactlyOneTarget(array $data): void
    {
        $hasWard = ! empty($data['ward_id']);
        $hasEmployee = ! empty($data['employee_id']);

        if ($hasWard === $hasEmployee) {
            throw ValidationException::withMessages([
                'ward_id' => 'Isi salah satu: ward_id (untuk kodepoli) atau employee_id (untuk kodedokter), tidak boleh keduanya kosong atau keduanya terisi.',
            ]);
        }
    }
}
