<?php

namespace Modules\InventoryLinenTracking\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\InventoryLinenTracking\Database\Factories\LinenCycleFactory;

/**
 * Satu siklus cuci linen. Status HANYA boleh berubah lewat
 * Modules\InventoryLinenTracking\Services\LinenCycleService — bukan tulisan
 * langsung — supaya urutan tahap londri (kirim -> cuci -> kembali/rusak)
 * konsisten.
 */
class LinenCycle extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    public const STATUS_DIKIRIM_LONDRI = 'dikirim_londri';

    public const STATUS_DICUCI = 'dicuci';

    public const STATUS_KEMBALI_BERSIH = 'kembali_bersih';

    public const STATUS_RUSAK_HILANG = 'rusak_hilang';

    protected $fillable = ['linen_item_id', 'status', 'sent_at', 'received_at', 'quantity'];

    protected function casts(): array
    {
        return [
            'sent_at' => 'datetime',
            'received_at' => 'datetime',
            'quantity' => 'integer',
        ];
    }

    public function linenItem(): BelongsTo
    {
        return $this->belongsTo(LinenItem::class);
    }

    protected static function newFactory(): LinenCycleFactory
    {
        return LinenCycleFactory::new();
    }
}
