<?php

namespace Modules\LayananCriticalLabValue\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\LayananCriticalLabValue\Http\Requests\AcknowledgeCriticalLabValueRequest;
use Modules\LayananCriticalLabValue\Http\Requests\NotifyCriticalLabValueRequest;
use Modules\LayananCriticalLabValue\Http\Requests\StoreCriticalLabValueRequest;
use Modules\LayananCriticalLabValue\Http\Requests\UpdateCriticalLabValueRequest;
use Modules\LayananCriticalLabValue\Http\Resources\CriticalLabValueResource;
use Modules\LayananCriticalLabValue\Models\CriticalLabValue;
use Modules\LayananCriticalLabValue\Services\CriticalLabValueService;

class CriticalLabValueController extends Controller
{
    public function index(Request $request)
    {
        $query = CriticalLabValue::query();

        // Daftar kerja: default menampilkan semua, tapi ?unacknowledged=1
        // menyaring ke nilai kritis yang belum diakui dokter — inilah yang
        // seharusnya dipantau terus supaya tidak ada nilai kritis "hilang".
        if ($request->boolean('unacknowledged')) {
            $query->unacknowledged();
        }

        return CriticalLabValueResource::collection($query->orderBy('id', 'desc')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreCriticalLabValueRequest $request)
    {
        $data = $request->validated();
        $data['acknowledged'] = $data['acknowledged'] ?? false;
        $critical_value = CriticalLabValue::create($data);

        return (new CriticalLabValueResource($critical_value))->response()->setStatusCode(201);
    }

    public function show(CriticalLabValue $critical_value): CriticalLabValueResource
    {
        return new CriticalLabValueResource($critical_value);
    }

    public function update(UpdateCriticalLabValueRequest $request, CriticalLabValue $critical_value): CriticalLabValueResource
    {
        $critical_value->update($request->validated());

        return new CriticalLabValueResource($critical_value);
    }

    /**
     * Tandai nilai kritis sudah disampaikan ke dokter/petugas (lewat telepon,
     * lisan, dsb). Tidak mengirim notifikasi apapun — murni pencatatan bahwa
     * penyampaian itu sudah terjadi, oleh siapa dan kapan.
     */
    public function notify(NotifyCriticalLabValueRequest $request, CriticalLabValue $critical_value, CriticalLabValueService $service): CriticalLabValueResource
    {
        return new CriticalLabValueResource($service->markNotified(
            $critical_value,
            $request->validated('notified_to'),
            $request->user(),
        ));
    }

    /**
     * Tandai nilai kritis sudah diakui diterima oleh dokter/petugas yang
     * berwenang. Ditolak bila belum pernah ditandai notified (lihat
     * CriticalLabValueService::acknowledge()).
     */
    public function acknowledge(AcknowledgeCriticalLabValueRequest $request, CriticalLabValue $critical_value, CriticalLabValueService $service): CriticalLabValueResource
    {
        return new CriticalLabValueResource($service->acknowledge($critical_value, $request->user()));
    }
}
