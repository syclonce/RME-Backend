<?php

namespace Modules\GeneralReferralStatus\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralReferralStatus\Models\ReferralStatus;

class ReferralStatusController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return ReferralStatus::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:referral_statuses,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:referral_statuses,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ReferralStatus::create($data)->refresh(), 201);
    }

    public function show(ReferralStatus $referralStatus): ReferralStatus
    {
        return $referralStatus;
    }

    public function update(Request $request, ReferralStatus $referralStatus): ReferralStatus
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('referral_statuses', 'name')->ignore($referralStatus->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('referral_statuses', 'code')->ignore($referralStatus->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $referralStatus->update($data);

        return $referralStatus;
    }

    public function destroy(ReferralStatus $referralStatus)
    {
        $referralStatus->delete();

        return response()->json(null, 204);
    }
}