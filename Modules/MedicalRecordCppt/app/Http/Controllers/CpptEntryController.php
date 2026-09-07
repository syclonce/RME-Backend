<?php

namespace Modules\MedicalRecordCppt\Http\Controllers;

use App\Http\Concerns\GuardsMedicalRecord;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GeneralEmployee\Models\Employee;
use Modules\MedicalRecordCppt\Http\Requests\StoreCpptEntryRequest;
use Modules\MedicalRecordCppt\Http\Resources\CpptEntryResource;
use Modules\MedicalRecordCppt\Models\CpptEntry;

class CpptEntryController extends Controller
{
    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = CpptEntry::query()->with('recordedBy');

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return CpptEntryResource::collection($query->latest('recorded_at')->paginate($request->integer('per_page', 15)));
    }

    /**
     * CPPT adalah rekam medis legal — append-only, tanpa update/delete
     * (seperti VitalSign). Koreksi = baris baru; hapus histori = amendment.
     * Guard observer + store di bawah menutup tulisan ke episode final.
     */
    public function store(StoreCpptEntryRequest $request)
    {
        $data = $request->validated();
        $this->guardMedicalRecord($request, $data);
        $data['recorded_at'] ??= now();
        $data['recorded_by'] ??= Employee::query()->where('user_id', $request->user()->id)->value('id');
        abort_if(
            $data['recorded_by'] === null,
            422,
            'Akun Anda belum tertaut ke data pegawai. Hubungi admin untuk menautkannya.'
        );

        $entry = CpptEntry::create($data);

        return (new CpptEntryResource($entry))->response()->setStatusCode(201);
    }

    public function show(CpptEntry $cppt_entry): CpptEntryResource
    {
        return new CpptEntryResource($cppt_entry->load('recordedBy'));
    }
}
