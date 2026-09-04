<?php

namespace Tests\Feature\Contracts;

use Tests\TestCase;

/**
 * Kolom `status` tidak boleh menerima teks bebas dari klien.
 *
 * Ditemukan lewat pemanggilan HTTP sungguhan: 17 modul memakai
 * `['sometimes', 'string', 'max:255']`, sehingga
 *
 *     POST /api/v1/nursing-diagnoses  {"status": "pisang-goreng"}
 *
 * tersimpan apa adanya ke rekam medis. Setiap layar yang menyaring status akan
 * melewatkan baris itu diam-diam — dan status yang tidak dikenal tidak dapat
 * dikoreksi lewat state machine mana pun, karena tidak ada transisi yang
 * berangkat darinya.
 *
 * Tes ini memindai SELURUH Request di repo, bukan daftar tetap: pola aslinya
 * lahir dari scaffold, jadi modul baru akan mewarisinya kecuali dicegah.
 */
class StatusEnumerationTest extends TestCase
{
    public function test_no_request_accepts_free_text_status(): void
    {
        $offenders = [];

        foreach (glob(base_path('Modules/*/app/Http/Requests/*.php')) as $file) {
            $source = file_get_contents($file);

            // Aturan status tanpa daftar nilai: 'string' + 'max:N' saja.
            if (preg_match("/'status' => \[[^\]]*'max:\d+'[^\]]*\]/", $source, $match)
                && ! str_contains($match[0], 'in:')
                && ! str_contains($match[0], 'Rule::in')) {
                $offenders[] = str_replace(base_path().'/', '', $file);
            }
        }

        $this->assertSame(
            [],
            $offenders,
            "Request berikut menerima status teks bebas. Batasi ke daftar nilai yang benar-benar "
            ."dipakai modulnya (`'in:a,b,c'`), karena status di luar daftar tersimpan permanen dan "
            ."tidak dapat dikoreksi lewat transisi mana pun:\n  ".implode("\n  ", $offenders),
        );
    }
}
