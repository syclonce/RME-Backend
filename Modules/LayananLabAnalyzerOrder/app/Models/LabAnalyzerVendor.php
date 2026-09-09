<?php

namespace Modules\LayananLabAnalyzerOrder\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\LayananLabAnalyzerOrder\Database\Factories\LabAnalyzerVendorFactory;

/**
 * Katalog vendor/driver analyzer LIS (Novanet, Vanslab, Winacom). Port semangat
 * driver LISService simgos2 sebagai data referensi saja - modul ini sengaja
 * TIDAK memuat bridging protokol HL7/ASTM sungguhan.
 */
class LabAnalyzerVendor extends Model
{
    use HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'vendor_name',
        'connection_notes',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(LabAnalyzerOrder::class);
    }

    protected static function newFactory(): LabAnalyzerVendorFactory
    {
        return LabAnalyzerVendorFactory::new();
    }
}
