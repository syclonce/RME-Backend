<?php

namespace Modules\GeneralDiagnosisCode\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralDiagnosisCodeDatabaseSeeder extends Seeder
{
    /** Sisipkan per potongan sebesar ini agar tidak menahan memori terlalu banyak. */
    private const CHUNK = 1000;

    /**
     * Kamus diagnosis ICD-10 (±40.800 kode).
     *
     * Sumber: SIMpel legacy — `master.mrconso` dengan `SAB='ICD_10_2010_IM'`
     * dan `TTY='PT'` (preferred term), yaitu kamus yang dipakai modul Diagnosis
     * SIMpel. Versi 2010 Indonesian Modification inilah yang menjadi acuan
     * klaim INA-CBG.
     *
     * Datanya disimpan sebagai CSV terpisah (`database/data/icd10.csv`), bukan
     * array PHP, karena 40 ribu baris akan membuat file seeder mustahil dibaca
     * dan lambat di-parse setiap kali autoload.
     *
     * Kode kategori induk (mis. `A00` "Cholera") ikut disertakan meski
     * `VALIDCODE=0` — tidak dipakai sebagai diagnosis final, tetapi membantu
     * penelusuran saat koder mencari dari kategori ke sub-kode.
     *
     * Idempoten: memakai upsert berdasarkan `code` (kolomnya unik).
     */
    public function run(): void
    {
        $path = __DIR__ . '/../data/icd10.csv';

        if (! is_file($path)) {
            $this->command?->warn("Berkas ICD-10 tidak ditemukan: {$path} — dilewati.");

            return;
        }

        $handle = fopen($path, 'r');
        if ($handle === false) {
            $this->command?->warn("Tidak dapat membuka {$path} — dilewati.");

            return;
        }

        $now = now();
        $buffer = [];
        $total = 0;

        while (($row = fgetcsv($handle, 0, ',', '"', '\\')) !== false) {
            [$code, $name] = [trim($row[0] ?? ''), trim($row[1] ?? '')];
            if ($code === '' || $name === '') {
                continue;
            }

            $buffer[] = [
                'code' => $code,
                'name' => $name,
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            if (count($buffer) >= self::CHUNK) {
                $this->flush($buffer);
                $total += count($buffer);
                $buffer = [];
            }
        }

        fclose($handle);

        if ($buffer !== []) {
            $this->flush($buffer);
            $total += count($buffer);
        }

        $this->command?->info("Diagnosis ICD-10: {$total} kode disinkronkan.");
    }

    /** @param array<int, array<string, mixed>> $rows */
    private function flush(array $rows): void
    {
        // upsert (bukan updateOrInsert per baris) supaya 40 ribu baris tidak
        // menjadi 40 ribu query terpisah.
        DB::table('diagnosis_codes')->upsert($rows, ['code'], ['name', 'is_active', 'updated_at']);
    }
}
