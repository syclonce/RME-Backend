<?php

namespace Modules\PembayaranCashierShift\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranCashier\Models\Cashier;
use Modules\PembayaranCashierShift\Models\CashierShift;
use Modules\PembayaranCashierShift\Services\CashierShiftService;

class CashierShiftController extends Controller
{
    public function index(Request $request)
    {
        $query = CashierShift::query();
        if ($request->filled('cashier_id')) {
            $query->where('cashier_id', $request->integer('cashier_id'));
        }
        return response()->json(['data' => $query->latest('opened_at')->paginate($request->integer('per_page', 15))]);
    }

    public function open(Request $request, Cashier $cashier, CashierShiftService $service)
    {
        $data = $request->validate(['initial_cash' => ['required', 'numeric', 'min:0']]);
        return response()->json(['data' => $service->open($cashier, $request->user(), (float) $data['initial_cash'])], 201);
    }

    public function close(Request $request, CashierShift $shift, CashierShiftService $service)
    {
        $data = $request->validate([
            'actual_cash' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);
        return response()->json(['data' => $service->close($shift, $request->user(), (float) $data['actual_cash'], $data['notes'] ?? null)]);
    }
}
