<?php

namespace Modules\MedicalRecordOtherHistory\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordOtherHistory\Http\Requests\StoreOtherHistoryRequest;
use Modules\MedicalRecordOtherHistory\Http\Resources\OtherHistoryResource;
use Modules\MedicalRecordOtherHistory\Models\OtherHistory;

class OtherHistoryController extends Controller
{
    use SearchesListing;

    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = OtherHistory::query();

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return OtherHistoryResource::collection($query->latest('recorded_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreOtherHistoryRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'recorded_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);
        $data['recorded_at'] ??= now();
        $data['created_by'] = $request->user()->id;

        $record = OtherHistory::create($data);

        return (new OtherHistoryResource($record))->response()->setStatusCode(201);
    }

    public function show(OtherHistory $record): OtherHistoryResource
    {
        return new OtherHistoryResource($record);
    }
}
