<?php

namespace Modules\GeneralPaymentType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPaymentType\Models\PaymentType;

class PaymentTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return PaymentType::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:payment_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:payment_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PaymentType::create($data)->refresh(), 201);
    }

    public function show(PaymentType $paymentType): PaymentType
    {
        return $paymentType;
    }

    public function update(Request $request, PaymentType $paymentType): PaymentType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('payment_types', 'name')->ignore($paymentType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('payment_types', 'code')->ignore($paymentType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $paymentType->update($data);

        return $paymentType;
    }

    public function destroy(PaymentType $paymentType)
    {
        $paymentType->delete();

        return response()->json(null, 204);
    }
}