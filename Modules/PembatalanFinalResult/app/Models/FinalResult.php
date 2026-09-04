<?php
namespace Modules\PembatalanFinalResult\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class FinalResult extends Model {
    use HasFactory, HydratesDatabaseDefaults;

    /**
     * Pembatalan sudah dijalankan: RME kunjungan sudah dibuka kembali.
     *
     * Legacy tidak punya status antara sama sekali -- tabel
     * `pembatalan.pembatalan_final_hasil` tidak memiliki kolom STATUS, karena
     * insert-nya SENDIRI yang membatalkan (trigger
     * pembatalan_final_hasil_after_insert). Jadi tidak ada 'pending' yang
     * bermakna: begitu barisnya ada, pembatalannya sudah terjadi.
     */
    public const STATUS_APPLIED = 'applied';

    /** Keputusan pembatalan ditarik kembali (tanpa padanan legacy). */
    public const STATUS_REVERSED = 'reversed';
    protected $table = 'final_result_cancellations';
    protected $fillable = ['visit_id', 'cancellation_number', 'reason', 'cancellation_date', 'requested_by', 'status'];
    protected $casts = ['cancellation_date' => 'datetime'];
    public static function generateCancellationNumber(): string {
        return NumberSequence::format('FRC', 'final_result_cancellation', now()->format('Y'));
    }
    protected static function newFactory() {
        return \Modules\PembatalanFinalResult\Database\Factories\FinalResultFactory::new();
    }
}
