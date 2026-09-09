<?php

namespace Modules\CetakanPrintDocument\Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\CetakanPrintDocument\Models\PrintDocument;
use Tests\TestCase;

/**
 * Nomor seri harian ala generator.generateIdKarcis simgos2:
 * {PREFIX}-{YYMMDD}-{seq4} berurut per jenis dokumen.
 */
class DocumentNumberGeneratorTest extends TestCase
{
    use RefreshDatabase;

    public function test_format_nomor_pertama_per_jenis(): void
    {
        $stamp = now()->format('ymd');

        $this->assertSame("RCPT-{$stamp}-0001", PrintDocument::generateDocumentNumber(PrintDocument::TYPE_RECEIPT));
        $this->assertSame("KRCS-{$stamp}-0001", PrintDocument::generateDocumentNumber(PrintDocument::TYPE_KARCIS));
        $this->assertSame("WSTB-{$stamp}-0001", PrintDocument::generateDocumentNumber(PrintDocument::TYPE_WRISTBAND));
        $this->assertSame("TRCR-{$stamp}-0001", PrintDocument::generateDocumentNumber(PrintDocument::TYPE_TRACER));
    }

    public function test_sequence_naik_per_jenis_dalam_hari(): void
    {
        $stamp = now()->format('ymd');

        // Nomor diterbitkan lewat generator, BUKAN dengan menyisipkan baris
        // ke tabel dokumen. Deretnya berdiri sendiri di number_sequences --
        // itulah yang membuatnya tidak bisa dimundurkan oleh penghapusan
        // baris dokumen, dan tidak perlu membaca tabel yang sedang ditulis.
        $this->assertSame("RCPT-{$stamp}-0001", PrintDocument::generateDocumentNumber(PrintDocument::TYPE_RECEIPT));
        $this->assertSame("RCPT-{$stamp}-0002", PrintDocument::generateDocumentNumber(PrintDocument::TYPE_RECEIPT));
        $this->assertSame("RCPT-{$stamp}-0003", PrintDocument::generateDocumentNumber(PrintDocument::TYPE_RECEIPT));

        // Jenis lain punya deret sendiri, tak terpengaruh urutan RCPT.
        $this->assertSame("KRCS-{$stamp}-0001", PrintDocument::generateDocumentNumber(PrintDocument::TYPE_KARCIS));
    }

    /**
     * Menghapus dokumen tidak memundurkan deret. Pada generator lama yang
     * membaca max() dari tabel dokumen, menghapus baris terakhir membuat nomor
     * berikutnya mengulang nomor yang sudah pernah tercetak -- dan nomor kuitansi
     * yang terbit dua kali adalah masalah keuangan, bukan sekadar kerapian.
     */
    public function test_menghapus_dokumen_tidak_memundurkan_deret(): void
    {
        $stamp = now()->format('ymd');

        PrintDocument::query()->create([
            'document_type' => PrintDocument::TYPE_RECEIPT,
            'ref_type' => 'payments',
            'ref_id' => 1,
            'document_number' => PrintDocument::generateDocumentNumber(PrintDocument::TYPE_RECEIPT),
            'issued_at' => now(),
        ])->delete();

        $this->assertSame("RCPT-{$stamp}-0002", PrintDocument::generateDocumentNumber(PrintDocument::TYPE_RECEIPT));
    }
}
