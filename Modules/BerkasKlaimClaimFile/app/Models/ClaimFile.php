<?php

namespace Modules\BerkasKlaimClaimFile\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaimFile extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_PROCESSED = 'processed';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_PAID = 'paid';

    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_SUBMITTED,
        self::STATUS_PROCESSED,
        self::STATUS_REJECTED,
        self::STATUS_PAID,
    ];

    /**
     * Transisi maju saja -- klaim yang sudah submitted tidak boleh kembali ke
     * draft utk diedit ulang lewat endpoint biasa (harus lewat alur
     * pembatalan/reissue formal, belum ada di scope ini).
     *
     * @var array<string, list<string>>
     */
    public const ALLOWED_TRANSITIONS = [
        self::STATUS_DRAFT => [self::STATUS_SUBMITTED],
        self::STATUS_SUBMITTED => [self::STATUS_PROCESSED, self::STATUS_REJECTED],
        self::STATUS_PROCESSED => [self::STATUS_PAID],
        self::STATUS_REJECTED => [],
        self::STATUS_PAID => [],
    ];

    protected $fillable = ['visit_id', 'invoice_id', 'claim_number', 'submitted_at', 'status'];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];

    public static function generateClaimNumber(): string
    {
        return NumberSequence::format('CLM', 'claim_file', now()->format('Y'));
    }

    protected static function newFactory()
    {
        return \Modules\BerkasKlaimClaimFile\Database\Factories\ClaimFileFactory::new();
    }
}
