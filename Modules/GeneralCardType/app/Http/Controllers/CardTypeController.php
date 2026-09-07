<?php

namespace Modules\GeneralCardType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralCardType\Models\CardType;

class CardTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(CardType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:card_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:card_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(CardType::create($data)->refresh(), 201);
    }

    public function show(CardType $cardType): CardType
    {
        return $cardType;
    }

    public function update(Request $request, CardType $cardType): CardType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('card_types', 'name')->ignore($cardType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('card_types', 'code')->ignore($cardType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $cardType->update($data);

        return $cardType;
    }

    public function destroy(CardType $cardType)
    {
        $cardType->delete();

        return response()->json(null, 204);
    }
}