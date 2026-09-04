<?php

namespace Modules\LayananLeftoverMedicationVoucher\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananLeftoverMedicationVoucher\Http\Requests\StoreLeftoverMedicationVoucherRequest;
use Modules\LayananLeftoverMedicationVoucher\Http\Requests\UpdateLeftoverMedicationVoucherRequest;
use Modules\LayananLeftoverMedicationVoucher\Http\Resources\LeftoverMedicationVoucherResource;
use Modules\LayananLeftoverMedicationVoucher\Models\LeftoverMedicationVoucher;
use Modules\LayananLeftoverMedicationVoucher\Services\LeftoverMedicationVoucherService;

class LeftoverMedicationVoucherController extends Controller
{
    public function index(Request $request)
    {
        $query = LeftoverMedicationVoucher::query();

        return LeftoverMedicationVoucherResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreLeftoverMedicationVoucherRequest $request, LeftoverMedicationVoucherService $service)
    {
        $voucher = $service->create($request->validated(), $request->user());

        return (new LeftoverMedicationVoucherResource($voucher))->response()->setStatusCode(201);
    }

    public function show(LeftoverMedicationVoucher $voucher): LeftoverMedicationVoucherResource
    {
        return new LeftoverMedicationVoucherResource($voucher);
    }

    /**
     * Gerbang forward-only: pending->redeemed dan pending->expired saja.
     * Sekali redeemed/expired, status tidak bisa diubah lagi lewat endpoint
     * ini (mencegah reset ke pending lalu redeem ulang). redeemed_at
     * distempel server saat transisi ke redeemed, bukan dari input klien.
     */
    public function update(UpdateLeftoverMedicationVoucherRequest $request, LeftoverMedicationVoucher $voucher, LeftoverMedicationVoucherService $service): LeftoverMedicationVoucherResource
    {
        return new LeftoverMedicationVoucherResource($service->transition($voucher, $request->validated('status'), $request->user()));
    }
}
