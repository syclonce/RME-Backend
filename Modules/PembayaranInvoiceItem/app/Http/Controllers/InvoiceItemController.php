<?php

namespace Modules\PembayaranInvoiceItem\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\VisitGate;
use Illuminate\Http\Request;
use Modules\GeneralService\Models\Service;
use Modules\PembayaranInvoice\Models\Invoice;
use Modules\PembayaranInvoiceItem\Http\Requests\StoreInvoiceItemRequest;
use Modules\PembayaranInvoiceItem\Http\Requests\UpdateInvoiceItemRequest;
use Modules\PembayaranInvoiceItem\Http\Resources\InvoiceItemResource;
use Modules\PembayaranInvoiceItem\Models\InvoiceItem;

class InvoiceItemController extends Controller
{
    use SearchesListing;

    public function __construct(protected readonly VisitGate $visitGate)
    {
    }

    public function index(Request $request)
    {
        $query = InvoiceItem::query();

        if ($request->filled('invoice_id')) {
            $query->where('invoice_id', $request->integer('invoice_id'));
        }

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return InvoiceItemResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreInvoiceItemRequest $request)
    {
        $invoice = Invoice::findOrFail($request->integer('invoice_id'));
        abort_if($invoice->is_locked, 422, 'Tagihan ini sudah dikunci, tidak bisa ditambah item.');

        // Gerbang state machine kunjungan (ala DispenseService): layanan baru
        // tidak boleh ditagihkan ke kunjungan yang sudah pulang/batal.
        abort_if(
            ! $this->visitGate->isActive((int) $invoice->visit_id),
            422,
            'Kunjungan sudah pulang/batal; tidak bisa menambah item tagihan.',
        );

        $data = $request->validated();

        // Kebijakan identik dengan update(): petugas tidak boleh menetapkan
        // harga satuan -- termasuk lewat jalur pembuatan item baru ini.
        abort_if(
            $request->has('unit_price') && ! $request->user()->hasRole('admin'),
            403,
            'Hanya admin yang dapat menetapkan harga satuan item tagihan.'
        );

        // Tutup celah sibling-write-path dari gerbang unit_price update():
        // kalau harga satuan tidak datang dari admin, nilainya WAJIB diambil
        // dari tarif katalog layanan -- bukan dari input klien. Tanpa ini,
        // petugas biasa cukup membuat item baru (bukan mengedit) untuk
        // menentukan harga bebas, termasuk menolkan tagihan.
        if (! isset($data['unit_price'])) {
            abort_if(
                empty($data['service_id']),
                422,
                'Petugas wajib memilih service_id agar harga mengikuti tarif katalog.'
            );

            $tariff = Service::query()->find($data['service_id'])?->currentTariff();
            abort_if(
                $tariff === null,
                422,
                'Tidak ada tarif katalog aktif untuk layanan ini.'
            );

            $data['unit_price'] = (float) $tariff->price;
        }

        $item = InvoiceItem::create($data);
        $invoice->recalculateTotals();

        return (new InvoiceItemResource($item))->response()->setStatusCode(201);
    }

    public function show(InvoiceItem $invoice_item): InvoiceItemResource
    {
        return new InvoiceItemResource($invoice_item);
    }

    public function update(UpdateInvoiceItemRequest $request, InvoiceItem $invoice_item): InvoiceItemResource
    {
        abort_if($invoice_item->invoice->is_locked, 422, 'Tagihan ini sudah dikunci, tidak bisa diubah.');

        // Gerbang state machine kunjungan: nilai tagihan kunjungan yang sudah
        // pulang/batal tidak boleh diubah dari jalur mana pun.
        abort_if(
            ! $this->visitGate->isActive((int) $invoice_item->invoice->visit_id),
            422,
            'Kunjungan sudah pulang/batal; item tagihan tidak bisa diubah.',
        );

        // unit_price bukan sekadar detail tampilan -- itu yang menentukan
        // subtotal/total_amount tagihan. Petugas biasa boleh koreksi
        // deskripsi/kuantitas, tapi mengubah harga satuan (mis. jadi 0)
        // hanya boleh admin, supaya ada jejak siapa yang menyunting nilai
        // finansial dan tidak sembarang akun kasir bisa nol-kan tagihan.
        abort_if(
            $request->has('unit_price') && ! $request->user()->hasRole('admin'),
            403,
            'Hanya admin yang dapat mengubah harga satuan item tagihan.'
        );

        $invoice_item->update($request->validated());
        $invoice_item->invoice->recalculateTotals();

        return new InvoiceItemResource($invoice_item);
    }

    public function destroy(InvoiceItem $invoice_item)
    {
        abort_if($invoice_item->invoice->is_locked, 422, 'Tagihan ini sudah dikunci, tidak bisa dihapus.');

        // Gerbang state machine kunjungan: baris tagihan kunjungan yang sudah
        // pulang/batal tidak boleh dibuang diam-diam.
        abort_if(
            ! $this->visitGate->isActive((int) $invoice_item->invoice->visit_id),
            422,
            'Kunjungan sudah pulang/batal; item tagihan tidak bisa dihapus.',
        );

        $invoice = $invoice_item->invoice;
        $invoice_item->delete();
        $invoice->recalculateTotals();

        return response()->json(null, 204);
    }
}
