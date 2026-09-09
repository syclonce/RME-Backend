<?php
namespace Modules\PembatalanReturnCancellation\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ReturnCancellation extends Model {
    use HasFactory, HydratesDatabaseDefaults;
    protected $fillable = ['return_id', 'cancellation_number', 'reason', 'cancellation_date', 'requested_by', 'status'];
    protected $casts = ['cancellation_date' => 'datetime'];
    public static function generateCancellationNumber(): string {
        return NumberSequence::format('RCN', 'return_cancellation', now()->format('Y'));
    }
    protected static function newFactory() {
        return \Modules\PembatalanReturnCancellation\Database\Factories\ReturnCancellationFactory::new();
    }
}
