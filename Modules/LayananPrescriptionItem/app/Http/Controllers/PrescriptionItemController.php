<?php

namespace Modules\LayananPrescriptionItem\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\InventoryItem\Models\Item;
use Modules\InventoryWardItemStock\Models\WardItemStock;
use Modules\LayananPrescription\Models\Prescription;
use Modules\LayananPrescriptionItem\Http\Requests\StorePrescriptionItemRequest;
use Modules\LayananPrescriptionItem\Http\Resources\PrescriptionItemResource;
use Modules\LayananPrescriptionItem\Models\PrescriptionItem;

class PrescriptionItemController extends Controller
{
    public function index(Request $request)
    {
        $query = PrescriptionItem::query();

        if ($request->filled('prescription_id')) {
            $query->where('prescription_id', $request->integer('prescription_id'));
        }

        return PrescriptionItemResource::collection($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StorePrescriptionItemRequest $request)
    {
        $data = $request->validated();

        $this->validateStockAvailability($data);

        $item = PrescriptionItem::create($data);

        return (new PrescriptionItemResource($item))->response()->setStatusCode(201);
    }

    /**
     * Validasi stok obat sebelum baris resep dibuat.
     *
     * Perbaikan dari implementasi lama di SIMGOS2 (OrderResepService::
     * isNotValidateStok(), line 304-325) yang punya tiga cacat: (1) hanya
     * aktif bila flag konfigurasi diaktifkan (mati secara bawaan, jadi
     * validasi efektif tidak pernah jalan di produksi), (2) menjumlahkan
     * stok SELURUH ruangan di rumah sakit alih-alih hanya depo/ruangan yang
     * benar-benar melayani kunjungan tsb (stok ruangan lain yang tidak bisa
     * dipakai pasien ikut dihitung sebagai "tersedia"), dan (3) memakai
     * `return;` tanpa nilai saat detail resep kosong sehingga null
     * dianggap valid alih-alih ditolak.
     *
     * Implementasi ini SELALU aktif (tidak digerbangi flag), dan memeriksa
     * stok pada ward_item_stocks milik ward kunjungan (Visit::ward_id) --
     * bukan total seluruh rumah sakit. Obat yang belum ditautkan ke katalog
     * inventaris (item_id null, masih nama bebas) tidak bisa divalidasi
     * stoknya dan dilewati, sesuai keterbatasan skema saat ini.
     */
    private function validateStockAvailability(array $data): void
    {
        if (empty($data['item_id']) || empty($data['quantity'])) {
            return;
        }

        $prescription = Prescription::query()->find($data['prescription_id']);
        $wardId = $prescription?->visit?->ward_id;

        $item = Item::query()->find($data['item_id']);
        $itemName = $item?->name ?? 'obat ini';

        // Stok diperiksa pada depo/ruangan yang melayani, BUKAN total seluruh
        // rumah sakit seperti `SUM(b.STOK)` legacy (OrderResepService.php:313) —
        // stok di gudang lain tidak dapat diserahkan ke pasien di sini.
        //
        // `ward_id` NULL berarti RAWAT JALAN: itu penanda resmi kunjungan rawat
        // jalan di SIMGOS (VisitController::index memakai whereNull('ward_id')),
        // bukan data yang belum lengkap. Menolaknya sebagai stok 0 akan
        // memblokir SELURUH resep rawat jalan. Untuk kasus ini stok dijumlahkan
        // lintas depo farmasi, karena pasien rawat jalan mengambil obat di
        // apotek mana pun yang melayani, bukan di bangsal tertentu.
        $availableStock = $wardId
            ? (int) (WardItemStock::query()
                ->where('item_id', $data['item_id'])
                ->where('ward_id', $wardId)
                ->value('quantity') ?? 0)
            : (int) WardItemStock::query()
                ->where('item_id', $data['item_id'])
                ->sum('quantity');

        if ($data['quantity'] > $availableStock) {
            throw ValidationException::withMessages([
                'quantity' => "Stok {$itemName} tidak mencukupi. Sisa stok tersedia: {$availableStock}.",
            ]);
        }
    }

    public function show(PrescriptionItem $prescription_item): PrescriptionItemResource
    {
        return new PrescriptionItemResource($prescription_item);
    }
}
