<?php

namespace Modules\GeneralReferralRoom\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralReferralRoom\Models\ReferralRoom;

class ReferralRoomController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(ReferralRoom::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:referral_rooms,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:referral_rooms,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ReferralRoom::create($data)->refresh(), 201);
    }

    public function show(ReferralRoom $referralRoom): ReferralRoom
    {
        return $referralRoom;
    }

    public function update(Request $request, ReferralRoom $referralRoom): ReferralRoom
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('referral_rooms', 'name')->ignore($referralRoom->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('referral_rooms', 'code')->ignore($referralRoom->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $referralRoom->update($data);

        return $referralRoom;
    }

    public function destroy(ReferralRoom $referralRoom)
    {
        $referralRoom->delete();

        return response()->json(null, 204);
    }
}