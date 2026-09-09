<?php

namespace Modules\PembayaranInvoice\Models;

use App\Models\Concerns\HydratesDatabaseDefaults;

use App\Support\NumberSequence;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\AuditActivityLog\Support\Auditable;
use Modules\Auth\Models\User;
use Modules\PembayaranInvoice\Database\Factories\InvoiceFactory;
use Modules\PembayaranInvoiceGuarantor\Models\InvoiceGuarantor;
use Modules\PembayaranInvoiceItem\Models\InvoiceItem;
use Modules\PembayaranPayment\Models\Payment;
use Modules\PendaftaranVisit\Models\Visit;

class Invoice extends Model
{
    use Auditable, HasFactory, HydratesDatabaseDefaults;

    protected $fillable = [
        'invoice_number',
        'visit_id',
        'invoice_date',
        'subtotal',
        'rounding_adjustment',
        'total_amount',
        'is_locked',
        'created_by',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'invoice_date' => 'datetime',
            'subtotal' => 'decimal:2',
            'rounding_adjustment' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'is_locked' => 'boolean',
        ];
    }

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Lampiran penjamin (port pembayaran.penjamin_tagihan simgos2) — model di
     * modul PembayaranInvoiceGuarantor (pemilik tabel); urutan sequence
     * menentukan penanggung utama.
     */
    public function guarantorAttachments(): HasMany
    {
        return $this->hasMany(InvoiceGuarantor::class)->orderBy('sequence');
    }

    /** Port getTotalPenjaminTagihan: SUM(TOTAL) baris penjamin, 2 desimal stabil. */
    public function coveredAmount(): string
    {
        return number_format((float) $this->guarantorAttachments()->sum('covered_amount'), 2, '.', '');
    }

    /**
     * Sisa yang ditanggung pasien TIDAK disimpan di mana pun (tidak ada dual
     * source of truth) - selalu dihitung dari total dikurangi coverage.
     */
    public function getPatientShareAttribute(): string
    {
        return number_format(max(0, (float) $this->total_amount - (float) $this->coveredAmount()), 2, '.', '');
    }

    /**
     * Recalculate subtotal/total from current line items. Call after any item
     * create/update/delete - not automatic, callers are responsible for invoking it.
     */
    public function recalculateTotals(): void
    {
        $subtotal = $this->items()->sum('subtotal');
        $total = $subtotal + $this->rounding_adjustment;

        // Total tagihan tidak boleh negatif -- rounding_adjustment sudah
        // dibatasi rentang wajar di UpdateInvoiceRequest, ini lapis kedua
        // (mis. subtotal 0 + rounding negatif masih bisa lolos rentang itu).
        abort_if($total < 0, 422, 'Total tagihan tidak boleh negatif.');

        // Total baru tidak boleh jatuh DI BAWAH uang yang sudah diterima kasir.
        // Tanpa gerbang ini, PUT rounding_adjustment negatif (atau penghapusan
        // item) bisa membuat collected > total pada tagihan yang masih terbuka,
        // sehingga sisa tagihan negatif, pelunasan tak terjadi, dan catatan
        // kas tidak konsisten dengan nilai tagihan.
        abort_if(
            $this->status !== 'cancelled'
                && (float) $this->payments()->where('status', 'completed')->sum('amount') > $total,
            422,
            'Total tagihan baru lebih kecil dari pembayaran yang sudah diterima.',
        );

        $this->update([
            'subtotal' => $subtotal,
            'total_amount' => $total,
        ]);
    }

    /**
     * Nomor diambil dari deret NumberSequence (padanan skema `generator`
     * simgos2): database yang menetapkan urutannya, bukan hitungan baris.
     * Aman terhadap permintaan bersamaan, dan nomor tidak didaur ulang.
     */
    public static function generateInvoiceNumber(): string
    {
        return NumberSequence::format('INV', 'invoice', now()->format('Y'));
    }

    protected static function newFactory(): InvoiceFactory
    {
        return InvoiceFactory::new();
    }
}
