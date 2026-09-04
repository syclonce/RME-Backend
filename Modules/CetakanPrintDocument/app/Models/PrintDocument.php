<?php

namespace Modules\CetakanPrintDocument\Models;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\Auth\Models\User;
use Modules\CetakanPrintDocument\Database\Factories\PrintDocumentFactory;

/**
 * Baris penerbitan dokumen cetak — padan karcis_pasien/kwitansi_pembayaran.
 */
class PrintDocument extends Model
{
    use Auditable, HasFactory;

    public const TYPE_RECEIPT = 'receipt';

    public const TYPE_KARCIS = 'karcis';

    public const TYPE_WRISTBAND = 'wristband';

    public const TYPE_TRACER = 'tracer';

    public const TYPE_PATIENT_CARD = 'patient_card';

    public const TYPES = [self::TYPE_RECEIPT, self::TYPE_KARCIS, self::TYPE_WRISTBAND, self::TYPE_TRACER, self::TYPE_PATIENT_CARD];

    /** Prefix nomor seri per jenis — ala generateIdKarcis/generateIdPenggunaAksesLog. */
    public const PREFIXES = [
        self::TYPE_RECEIPT => 'RCPT',
        self::TYPE_KARCIS => 'KRCS',
        self::TYPE_WRISTBAND => 'WSTB',
        self::TYPE_TRACER => 'TRCR',
        self::TYPE_PATIENT_CARD => 'PCRD',
    ];

    protected $fillable = [
        'document_type',
        'ref_type',
        'ref_id',
        'document_number',
        'payload',
        'issued_by',
        'issued_at',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'issued_at' => 'datetime',
        ];
    }

    public function issuedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    /**
     * Payload = snapshot identitas pasien (karcis/kwitansi/gelang) — dilarang
     * tersalin ke activity_logs; jejak audit cukup document_number + ref.
     * Perubahan payload tetap tercatat sebagai peristiwa, isinya di-mask.
     *
     * @return array<int, string>
     */
    public function auditHidden(): array
    {
        return ['payload'];
    }

    /**
     * Format: {PREFIX}-{YYMMDD}-{seq4 harian}.
     *
     * Deretnya per-prefix per-hari, persis bentuk tabel penghitung legacy
     * (mis. generator.no_pendaftaran berkunci TANGGAL, LPAD 4 digit).
     * Sebelumnya nomor diturunkan dari max() baris yang ada -- aman dari daur
     * ulang, tapi hanya terlindung bila pemanggilnya kebetulan berada dalam
     * transaksi. NumberSequence tidak menitipkan syarat itu ke pemanggil.
     */
    public static function generateDocumentNumber(string $type): string
    {
        return NumberSequence::format(
            self::PREFIXES[$type],
            'print_document:'.$type,
            now()->format('ymd'),
            pad: 4,
        );
    }

    protected static function newFactory(): PrintDocumentFactory
    {
        return PrintDocumentFactory::new();
    }
}
