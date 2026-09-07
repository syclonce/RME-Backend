<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\GeneralWard\Models\Ward;
use Modules\PendaftaranRegistration\Models\Registration;
use Modules\PendaftaranVisit\Models\Visit;
use Modules\PendaftaranVisitDestination\Models\VisitDestination;
use Modules\PendaftaranWardQueue\Services\WardQueueService;

/**
 * Impor kunjungan legacy ke SIMGOS (lanjutan legacy:import-pendaftaran).
 *
 * Satu baris legacy `pendaftaran.kunjungan` (NOMOR, NOPEN, RUANGAN, MASUK,
 * KELUAR, STATUS 1=aktif/2=selesai/0=batal):
 * - Pendaftaran dicari via registration_number (NOPEN). Belum migrasi →
 *   karantina (rantai putus di hulu, bukan dibuat buta).
 * - Ruangan yatim → kunjungan TETAP diimpor tanpa ward (ward_id null =
 *   rawat jalan, konvensi yang sama dipakai alur) + dicatat.
 * - Nomor legacy dipertahankan sebagai visit_number (unik); tabrakan → lewati.
 * - STATUS 2 → discharged_at=KELUAR + status discharged; 0 → cancelled;
 *   selain itu active. Finalisasi layanan/RME TIDAK direkonstruksi (butuh
 *   kelengkapan klinis yang tak ada di baris kunjungan) — kunjungan
 *   selesai-legacy masuk sebagai discharged tanpa finalisasi (dicatat).
 * - Bila pendaftaran punya tujuan pending ke ward yang sama → tandai accepted
 *   + antrean served (realisasi atas rencana, pola VisitService::admit).
 *
 * Format masuk: JSON array; kunci: NOMOR, NOPEN, RUANGAN (opsional),
 * MASUK (Y-m-d H:i:s), KELUAR (opsional), STATUS (0/1/2, default 1).
 */
class ImportLegacyKunjungan extends Command
{
    protected $signature = 'legacy:import-kunjungan {file : path berkas JSON baris legacy} {--dry-run : validasi saja, tanpa menulis}';

    protected $description = 'Impor kunjungan legacy ke rantai Kunjungan SIMGOS';

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
        $nopen = isset($row['NOPEN']) && $row['NOPEN'] !== '' ? (string) $row['NOPEN'] : null;
        $registration = $nopen !== null
            ? Registration::query()->firstWhere('registration_number', $nopen)
            : null;

        if ($registration === null) {
            return ['status' => 'quarantined', 'reason' => "pendaftaran NOPEN {$nopen} belum dimigrasi — impor pendaftaran dulu"];
        }

        $nomor = isset($row['NOMOR']) && $row['NOMOR'] !== '' ? (string) $row['NOMOR'] : null;

        if ($nomor !== null && Visit::query()->where('visit_number', $nomor)->exists()) {
            return ['status' => 'skipped', 'reason' => "kunjungan {$nomor} sudah ada"];
        }

        $validator = Validator::make(
            ['visit_number' => $nomor],
            ['visit_number' => ['nullable', 'string', 'max:255', 'unique:visits,visit_number']]
        );

        if ($validator->fails()) {
            return ['status' => 'quarantined', 'reason' => (string) $validator->errors()->first()];
        }

        if ($this->option('dry-run')) {
            return ['status' => 'imported'];
        }

        return DB::transaction(function () use ($registration, $nomor, $row, $queue) {
            $wardId = isset($row['RUANGAN']) && $row['RUANGAN'] !== ''
                ? Ward::query()->whereKey($row['RUANGAN'])->value('id')
                : null;

            $statusLegacy = (int) ($row['STATUS'] ?? 1);
            $keluar = $row['KELUAR'] ?? null;

            $visit = Visit::create([
                'visit_number' => $nomor ?? Visit::generateVisitNumber(),
                'registration_id' => $registration->id,
                'ward_id' => $wardId,
                'admitted_at' => isset($row['MASUK']) ? Carbon::parse($row['MASUK']) : now(),
                'discharged_at' => $statusLegacy === 2 && $keluar ? Carbon::parse($keluar) : null,
                'status' => match ($statusLegacy) {
                    2 => 'discharged',
                    0 => 'cancelled',
                    default => 'active',
                },
            ]);

            if ($wardId !== null) {
                VisitDestination::query()
                    ->where('registration_id', $registration->id)
                    ->where('ward_id', $wardId)
                    ->where('status', VisitDestination::STATUS_PENDING)
                    ->update(['status' => VisitDestination::STATUS_ACCEPTED]);
                $queue->markServed($registration->id, (int) $wardId, $visit->id);
            }

            return ['status' => 'imported'];
        });
    }
}
