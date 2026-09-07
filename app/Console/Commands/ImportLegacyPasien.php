<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\GeneralPatient\Models\Patient;

/**
 * Impor pasien dari dump legacy SIMGOS2 ke skema SIMGOS.
 *
 * Penyelarasan dengan SIMGOS (bukan salinan skema legacy):
 * - Charset: seluruh tabel inti legacy `CHARSET=latin1` — tiap string
 *   dikonversi ke UTF-8 sebelum validasi, kalau tidak karakter non-ASCII
 *   (nama, alamat) rusak diam-diam di kolom utf8mb4.
 * - NORM (`int AUTO_INCREMENT` legacy) dipertahankan sebagai
 *   `medical_record_number` (string unik) — padding hanya tampilan, jadi
 *   disimpan apa adanya; duplikat NORM dilewati, bukan ditimpa (pintu
 *   `NORM_MANUAL` legacy menabrak tanpa cek — di sini tidak).
 * - Dedup 2 lapis ala `PasienService` (KTP, lalu demografis 5-field) berjalan
 *   SEBELUM insert; baris yatim/tak-valid masuk karantina, bukan dipaksa masuk
 *   (FK `constrained()` SIMGOS akan menolaknya — dan memang harus menolak).
 * - FK referensi (agama, pekerjaan, dsb.) memakai kode legacy yang BERBEDA
 *   dari id SIMGOS — sengaja dibiarkan null (kolom nullable) untuk diisi fase
 *   pemetaan master; memaksakan id legacy ke kolom SIMGOS justru menciptakan
 *   orphan yang dilarang skema.
 *
 * Format masuk: JSON array, satu objek per baris legacy `master.pasien`
 * (kunci dipakai bila ada): NORM, NAMA, TANGGAL_LAHIR (Y-m-d), TEMPAT_LAHIR,
 * JENIS_KELAMIN, ALAMAT, RT, RW, KODEPOS, NIK (16 digit, opsional).
 */
class ImportLegacyPasien extends Command
{
    protected $signature = 'legacy:import-pasien {file : path berkas JSON baris legacy} {--dry-run : validasi saja, tanpa menulis}';

    protected $description = 'Impor pasien legacy ke skema SIMGOS (konversi charset, dedup, karantina orphan)';

    public function handle(): int
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
            $result = $this->importRow(is_array($row) ? $row : []);

            match ($result['status']) {
                'imported' => $imported++,
                'skipped' => $skipped[] = ['baris' => $i, 'alasan' => $result['reason']],
                'quarantined' => $quarantined[] = ['baris' => $i, 'alasan' => $result['reason'], 'data' => $row],
            };
        }

        $quarantinePath = $this->writeQuarantine($path, $quarantined);

        $this->table(
            ['hasil', 'jumlah'],
            [
                ['diimpor', $imported],
                ['dilewati (duplikat)', count($skipped)],
                ['karantina', count($quarantined)],
            ]
        );

        if ($quarantinePath !== null) {
            $this->line("Karantina ditulis ke: {$quarantinePath}");
        }

        foreach (array_slice($skipped, 0, 10) as $s) {
            $this->line("Lewati baris {$s['baris']}: {$s['alasan']}");
        }

        return self::SUCCESS;
    }

    /** @return array{status: string, reason?: string} */
    public function importRow(array $row): array
    {
        $data = $this->normalize($row);

        // Dedup lapis 1: NORM sudah ada (pintu NORM_MANUAL yang aman).
        if ($data['medical_record_number'] !== null && Patient::query()
            ->where('medical_record_number', $data['medical_record_number'])->exists()) {
            return ['status' => 'skipped', 'reason' => "NORM {$data['medical_record_number']} sudah ada"];
        }

        // Dedup lapis 2: NIK sudah ada.
        if ($data['nik'] !== null && Patient::query()->where('nik', $data['nik'])->exists()) {
            return ['status' => 'skipped', 'reason' => "NIK {$data['nik']} sudah terdaftar"];
        }

        // Dedup lapis 3: demografis 5-field (nama + tgl + tempat lahir + JK + alamat).
        if ($this->demographicDuplicate($data)) {
            return ['status' => 'skipped', 'reason' => 'duplikat demografis (nama+tgl+tempat+JK+alamat sama)'];
        }

        $validator = Validator::make($data, [
            'medical_record_number' => ['nullable', 'string', 'max:255', 'unique:patients,medical_record_number'],
            'nik' => ['nullable', 'digits:16', 'unique:patients,nik'],
            'name' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
        ]);

        if ($validator->fails()) {
            return ['status' => 'quarantined', 'reason' => $validator->errors()->first()];
        }

        if ($this->option('dry-run')) {
            return ['status' => 'imported'];
        }

        DB::transaction(fn () => Patient::create($validator->validated()));

        return ['status' => 'imported'];
    }

    /** @return array<string, mixed> */
    private function normalize(array $row): array
    {
        // Konversi latin1 → UTF-8 per field (bukan per berkas — berkas JSON
        // sudah UTF-8, tetapi nilai dump legacy bisa membawa byte latin1).
        $latin = fn (?string $v): ?string => $v === null || $v === ''
            ? null
            : mb_convert_encoding($v, 'UTF-8', 'UTF-8, ISO-8859-1');

        $nik = isset($row['NIK']) && preg_match('/^\d{16}$/', (string) $row['NIK'])
            ? (string) $row['NIK']
            : null;

        return [
            'medical_record_number' => isset($row['NORM']) && $row['NORM'] !== '' ? (string) $row['NORM'] : null,
            'nik' => $nik,
            'name' => $latin(isset($row['NAMA']) ? (string) $row['NAMA'] : null) ?? 'Tanpa Nama',
            'birth_place' => $latin(isset($row['TEMPAT_LAHIR']) ? (string) $row['TEMPAT_LAHIR'] : null),
            'birth_date' => $row['TANGGAL_LAHIR'] ?? null,
            'address' => $latin(isset($row['ALAMAT']) ? (string) $row['ALAMAT'] : null),
            'rt' => isset($row['RT']) ? (string) $row['RT'] : null,
            'rw' => isset($row['RW']) ? (string) $row['RW'] : null,
            'postal_code' => isset($row['KODEPOS']) ? (string) $row['KODEPOS'] : null,
            // Konteks dedup demografis (bukan kolom pasien): JK legacy mentah.
            '_jk' => $row['JENIS_KELAMIN'] ?? null,
        ];
    }

    /** @param array<string, mixed> $data */
    private function demographicDuplicate(array $data): bool
    {
        if ($data['birth_date'] === null) {
            return false;
        }

        return Patient::query()
            ->where('name', $data['name'])
            ->whereDate('birth_date', (string) $data['birth_date'])
            ->where('birth_place', $data['birth_place'])
            ->where('address', $data['address'])
            ->exists();
    }

    /**
     * @param list<array<string, mixed>> $quarantined
     */
    private function writeQuarantine(string $sourcePath, array $quarantined): ?string
    {
        if ($quarantined === []) {
            return null;
        }

        $path = preg_replace('/\.json$/i', '', $sourcePath).'.quarantine.json';
        file_put_contents((string) $path, json_encode($quarantined, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return (string) $path;
    }
}
