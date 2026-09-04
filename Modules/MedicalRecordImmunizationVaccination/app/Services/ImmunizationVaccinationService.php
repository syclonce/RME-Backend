<?php

namespace Modules\MedicalRecordImmunizationVaccination\Services;

use App\Modules\Contracts\MedicalRecordGate;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Models\User;
use Modules\MedicalRecordImmunizationVaccination\Models\ImmunizationVaccination;

/**
 * Imunisasi TIDAK punya state machine yang bermakna - berbeda dari
 * LabOrderService/RadiologyOrderService (order -> diproses -> selesai),
 * pemberian vaksin adalah peristiwa sekali-jadi: dicatat, selesai. Tidak ada
 * kolom lain yang pernah dipakai sebagai nilai status (lihat migrasi, factory,
 * seeder - semuanya cuma 'completed'). Memaksakan TRANSITIONS di sini akan
 * jadi state machine kosong tanpa transisi nyata.
 *
 * Yang tetap wajib: MedicalRecordGate::assertWritable() pada create/update/
 * delete supaya catatan imunisasi tidak bisa ditulis atau diubah pada
 * kunjungan yang RME-nya sudah final. Kolom status dikunci ke 'completed' -
 * tidak pernah diterima dari request.
 */
class ImmunizationVaccinationService
{
    public function __construct(protected MedicalRecordGate $medicalRecordGate) {}

    /** @param array<string, mixed> $data */
    public function create(array $data, User $user): ImmunizationVaccination
    {
        if (! empty($data['visit_id'])) {
            $this->medicalRecordGate->assertWritable((int) $data['visit_id'], $user);
        }

        return DB::transaction(fn () => ImmunizationVaccination::create([
            ...Arr::except($data, 'status'),
            'status' => 'completed',
        ]));
    }

    /** @param array<string, mixed> $data */
    public function update(ImmunizationVaccination $record, array $data, User $user): ImmunizationVaccination
    {
        $visitId = $data['visit_id'] ?? $record->visit_id;
        if (! empty($visitId)) {
            $this->medicalRecordGate->assertWritable((int) $visitId, $user);
        }

        $record->update(Arr::except($data, 'status'));

        return $record->refresh();
    }

    public function delete(ImmunizationVaccination $record, User $user): void
    {
        if (! empty($record->visit_id)) {
            $this->medicalRecordGate->assertWritable((int) $record->visit_id, $user);
        }

        $record->delete();
    }
}
