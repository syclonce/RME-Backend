<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\GeneralPatient\Models\Patient;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;
use Modules\PendaftaranWardQueue\Services\WardQueueService;

/**
 * Impor pendaftaran legacy (NOPEN) ke rantai SIMGOS.
 *
 * Satu baris legacy = satu Registration + (bila ruangan valid) satu
 * VisitDestination + antrean (idempoten, port onAfterInsertTujuanPasien).
 * Penyelarasan skema SIMGOS:
 * - Pasien dicari via medical_record_number (NORM dipertahankan). Tanpa pasien
 *   → karantina (bukan dibuat buta — FK constrained() akan menolak).
 * - Ruangan legacy berkode hierarkis; dicocokkan ke wards.id apa adanya.
 *   Tak cocok → pendaftaran TETAP diimpor tanpa tujuan + dicatat (bukan
 *   karantina penuh — data administratifnya sah, tujuannya yang yatim).
 * - Dedup 1 pasien 1 pendaftaran aktif/hari (aturan yang sama dengan
 *   StoreRegistrationRequest) → dilewati.
 * - Nomor: NOPEN dipertahankan sebagai registration_number (unik); tabrakan
 *   → lewati.
 *
 * Format masuk: JSON array; kunci: NOPEN, NORM, TANGGAL (Y-m-d H:i:s),
 * RUANGAN (opsional), DOKTER_EMPLOYEE_ID (opsional, id employees SIMGOS).
 */
class ImportLegacyPendaftaran extends Command
{
    protected $signature = 'legacy:import-pendaftaran {file : path berkas JSON baris legacy} {--dry-run : validasi saja, tanpa menulis}';

    protected $description = 'Impor pendaftaran legacy (NOPEN) ke rantai Registration-Tujuan-Antrean SIMGOS';

    public function handle(WardQueueService $queue): int
    {
        $path = (string) $this->argument('file');

        if (! is_file($path)) {
            $this->error("Berkas tidak ditemukan: {$path}");

            return self::FAILURE;
        }

        $rows = json_decode((string) file_get_contents($path), true);

        if (! is_array($rows)) {
            $this->error('Berkas bukan JSON array yang valid.');

            return self::FAILURE;
        }

        $imported = 0;
        $skipped = [];
        $quarantined = [];

        foreach ($rows as $i => $row) {
            $result = $this->importRow(is_array($row) ? $row : [], $queue);

            match ($result['status']) {
                'imported' => $imported++,
                'skipped' => $skipped[] = ['baris' => $i, 'alasan' => $result['reason']],
                'quarantined' => $quarantined[] = ['baris' => $i, 'alasan' => $result['reason'], 'data' => $row],
            };
        }

        if ($quarantined !== []) {
            $qp = preg_replace('/\.json$/i', '', $path).'.quarantine.json';
            file_put_contents((string) $qp, json_encode($quarantined, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $this->line("Karantina ditulis ke: {$qp}");
        }

        $this->table(
            ['hasil', 'jumlah'],
            [
                ['diimpor', $imported],
                ['dilewati (duplikat)', count($skipped)],
                ['karantina', count($quarantined)],
            ]
        );

        return self::SUCCESS;
    }

    /** @return array{status: string, reason?: string} */
    public function importRow(array $row, WardQueueService $queue): array
    {
        $norm = isset($row['NORM']) && $row['NORM'] !== '' ? (string) $row['NORM'] : null;
        $patient = $norm !== null ? Patient::query()->firstWhere('medical_record_number', $norm) : null;

        if ($patient === null) {
            return ['status' => 'quarantined', 'reason' => "pasien NORM {$norm} belum dimigrasi — impor pasien dulu"];
        }

        $registeredAt = isset($row['TANGGAL']) ? Carbon::parse($row['TANGGAL']) : now();

        if (Registration::query()->where('patient_id', $patient->id)
            ->whereDate('registered_at', $registeredAt->toDateString())
            ->where('status', '!=', 'cancelled')->exists()) {
            return ['status' => 'skipped', 'reason' => "pasien sudah terdaftar pada {$registeredAt->toDateString()}"];
        }

        $nopen = isset($row['NOPEN']) && $row['NOPEN'] !== '' ? (string) $row['NOPEN'] : null;

        if ($nopen !== null && Registration::query()->where('registration_number', $nopen)->exists()) {
            return ['status' => 'skipped', 'reason' => "NOPEN {$nopen} sudah ada"];
        }

        $validator = Validator::make(
            ['registration_number' => $nopen, 'registered_at' => $registeredAt->toDateTimeString()],
            ['registration_number' => ['nullable', 'string', 'max:255', 'unique:registrations,registration_number']]
        );

        if ($validator->fails()) {
            return ['status' => 'quarantined', 'reason' => (string) $validator->errors()->first()];
        }

        if ($this->option('dry-run')) {
            return ['status' => 'imported'];
        }

        return DB::transaction(function () use ($patient, $registeredAt, $nopen, $row, $queue) {
            $registration = Registration::create([
                'registration_number' => $nopen ?? Registration::generateRegistrationNumber(),
                'patient_id' => $patient->id,
                'registered_at' => $registeredAt,
                'status' => 'active',
            ]);

            // Tujuan: hanya bila ruangan cocok. 1 NOPEN = 1 tujuan (unique).
            $wardId = isset($row['RUANGAN']) ? Ward::query()->whereKey($row['RUANGAN'])->value('id') : null;

            if ($wardId !== null && ! VisitDestination::query()->where('registration_id', $registration->id)->exists()) {
                $destination = VisitDestination::create([
                    'registration_id' => $registration->id,
                    'ward_id' => $wardId,
                    'doctor_id' => $row['DOKTER_EMPLOYEE_ID'] ?? null,
                    'status' => VisitDestination::STATUS_PENDING,
                ]);
                $queue->enqueue($destination->ward_id, $registration->id);
            }

            return ['status' => 'imported'];
        });
    }
}
