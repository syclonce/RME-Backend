<?php

namespace Modules\MedicalRecordRecordFileLoan\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordRecordFileLoan\Http\Requests\StoreRecordFileLoanRequest;
use Modules\MedicalRecordRecordFileLoan\Http\Requests\TransitionRecordFileLoanRequest;
use Modules\MedicalRecordRecordFileLoan\Http\Requests\UpdateRecordFileLoanRequest;
use Modules\MedicalRecordRecordFileLoan\Http\Resources\RecordFileLoanResource;
use Modules\MedicalRecordRecordFileLoan\Models\RecordFileLoan;
use Modules\MedicalRecordRecordFileLoan\Services\RecordFileLoanService;

class RecordFileLoanController extends Controller
{
    public function index(Request $request)
    {
        $query = RecordFileLoan::query();


        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->integer('patient_id'));
        }

        return RecordFileLoanResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreRecordFileLoanRequest $request, RecordFileLoanService $service)
    {
        $record = $service->create($request->validated());

        return (new RecordFileLoanResource($record))->response()->setStatusCode(201);
    }

    public function show(RecordFileLoan $record): RecordFileLoanResource
    {
        return new RecordFileLoanResource($record);
    }

    /**
     * Hanya field non-status yang bisa diedit di sini (nama peminjam, unit,
     * tujuan, tanggal jatuh tempo). Perubahan status lewat endpoint transisi
     * terpisah, lihat transition().
     */
    public function update(UpdateRecordFileLoanRequest $request, RecordFileLoan $record): RecordFileLoanResource
    {
        $record->update($request->validated());

        return new RecordFileLoanResource($record);
    }

    public function transition(TransitionRecordFileLoanRequest $request, RecordFileLoan $record, RecordFileLoanService $service): RecordFileLoanResource
    {
        return new RecordFileLoanResource($service->transition($record, $request->validated('status')));
    }

    public function destroy(RecordFileLoan $record)
    {
        $record->delete();

        return response()->noContent();
    }
}
