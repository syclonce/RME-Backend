<?php

namespace Modules\SystemTteDocument\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\GeneralEmployee\Models\Employee;
use Modules\SystemTteDocument\Database\Factories\TteDocumentFactory;

/**
 * TTE (Tanda Tangan Elektronik) internal -- state machine
 * draft -> pending_sign -> signed -> locked atas referensi polymorphic
 * (ref_type + ref_id, mis. resume medis). document_hash adalah SHA-256 dari
 * representasi JSON `content` yang dibekukan saat sign() dipanggil (tidak ada
 * panggilan eksternal ke PSrE/BSrE -- integrasi itu future work). Transisi
 * status HANYA lewat Modules\SystemTteDocument\Services\TteDocumentService.
 */
class TteDocument extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_DRAFT = 'draft';

    public const STATUS_PENDING_SIGN = 'pending_sign';

    public const STATUS_SIGNED = 'signed';

    public const STATUS_LOCKED = 'locked';

    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_PENDING_SIGN,
        self::STATUS_SIGNED,
        self::STATUS_LOCKED,
    ];

    protected $fillable = [
        'ref_type',
        'ref_id',
        'status',
        'content',
        'document_hash',
        'signed_by',
        'signed_at',
    ];

    protected function casts(): array
    {
        return [
            'content' => 'array',
            'signed_at' => 'datetime',
        ];
    }

    public function signedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'signed_by');
    }

    protected static function newFactory(): TteDocumentFactory
    {
        return TteDocumentFactory::new();
    }
}
