<?php
namespace Modules\PembatalanDocumentCancellation\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class DocumentCancellation extends Model {
    use HasFactory, HydratesDatabaseDefaults;
    protected $table = 'document_cancellations';
    protected $fillable = ['document_id', 'document_type', 'cancellation_number', 'reason', 'cancellation_date', 'requested_by', 'status'];
    protected $casts = ['cancellation_date' => 'datetime'];
    public static function generateCancellationNumber(): string {
        return NumberSequence::format('DCN', 'document_cancellation', now()->format('Y'));
    }
    protected static function newFactory() {
        return \Modules\PembatalanDocumentCancellation\Database\Factories\DocumentCancellationFactory::new();
    }
}
