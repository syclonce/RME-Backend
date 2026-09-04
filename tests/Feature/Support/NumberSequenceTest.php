<?php

namespace Tests\Feature\Support;

use App\Support\NumberSequence;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\PembatalanDocumentCancellation\Models\DocumentCancellation;
use Tests\TestCase;

/**
 * Port mekanisme skema `generator` simgos2
 * (db/new/generator/routines/generateNoPendaftaran.sql).
 */
class NumberSequenceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_increments_within_a_scope(): void
    {
        $this->assertSame(1, NumberSequence::next('invoice', '2026'));
        $this->assertSame(2, NumberSequence::next('invoice', '2026'));
        $this->assertSame(3, NumberSequence::next('invoice', '2026'));
    }

    /** Tiap cakupan punya deret sendiri -- padanan kunci majemuk RUANGAN/TANGGAL legacy. */
    public function test_scopes_are_independent(): void
    {
        NumberSequence::next('visit', '2026-09-04:ward-1');
        NumberSequence::next('visit', '2026-09-04:ward-1');

        $this->assertSame(1, NumberSequence::next('visit', '2026-09-04:ward-2'));
        $this->assertSame(1, NumberSequence::next('visit', '2026-09-05:ward-1'));
    }

    /** Nama deret berbeda tidak saling mengganggu. */
    public function test_names_are_independent(): void
    {
        NumberSequence::next('invoice', '2026');
        $this->assertSame(1, NumberSequence::next('payment', '2026'));
    }

    /**
     * Inti perbaikannya. Dengan `count()+1`, menghapus baris terakhir membuat
     * nomor berikutnya MENGULANG nomor yang sudah pernah dipakai -- dan kolom
     * cancellation_number itu unique, jadi baris berikutnya gagal disimpan.
     * Deret sejati tidak pernah mundur, sama seperti AUTO_INCREMENT legacy.
     */
    public function test_numbers_are_not_recycled_after_deletion(): void
    {
        $first = DocumentCancellation::generateCancellationNumber();
        $second = DocumentCancellation::generateCancellationNumber();

        DocumentCancellation::create([
            'document_id' => 'DOC-1',
            'document_type' => 'invoice',
            'cancellation_number' => $second,
            'reason' => 'salah entri',
            'cancellation_date' => now(),
            'requested_by' => 'petugas',
        ])->delete();

        $third = DocumentCancellation::generateCancellationNumber();

        $this->assertNotSame($first, $second);
        $this->assertNotSame($second, $third);
        $this->assertSame('DCN-'.now()->format('Y').'-000003', $third);
    }

    /** Nomor yang sudah terbit tidak boleh terbit dua kali dalam satu deret. */
    public function test_a_run_of_numbers_is_unique(): void
    {
        $numbers = [];
        for ($i = 0; $i < 50; $i++) {
            $numbers[] = DocumentCancellation::generateCancellationNumber();
        }

        $this->assertCount(50, array_unique($numbers));
    }
}
