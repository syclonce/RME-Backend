<?php

namespace Modules\GeneralPaymentTransactionType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralPaymentTransactionType\Models\PaymentTransactionType;

class PaymentTransactionTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(PaymentTransactionType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:payment_transaction_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:payment_transaction_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(PaymentTransactionType::create($data)->refresh(), 201);
    }

    public function show(PaymentTransactionType $paymentTransactionType): PaymentTransactionType
    {
        return $paymentTransactionType;
    }

    public function update(Request $request, PaymentTransactionType $paymentTransactionType): PaymentTransactionType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('payment_transaction_types', 'name')->ignore($paymentTransactionType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('payment_transaction_types', 'code')->ignore($paymentTransactionType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $paymentTransactionType->update($data);

        return $paymentTransactionType;
    }

    public function destroy(PaymentTransactionType $paymentTransactionType)
    {
        $paymentTransactionType->delete();

        return response()->json(null, 204);
    }
}