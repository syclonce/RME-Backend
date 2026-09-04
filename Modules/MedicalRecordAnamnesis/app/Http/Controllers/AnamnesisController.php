<?php

namespace Modules\MedicalRecordAnamnesis\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\MedicalRecordAnamnesis\Http\Requests\StoreAnamnesisRequest;
use Modules\MedicalRecordAnamnesis\Http\Requests\UpdateAnamnesisRequest;
use Modules\MedicalRecordAnamnesis\Http\Resources\AnamnesisResource;
use Modules\MedicalRecordAnamnesis\Models\Anamnesis;

class AnamnesisController extends Controller
{
    use ResolvesActingEmployee;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $request->validate([
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ]);

        $query = Anamnesis::query();

        // Tanpa filter ini, membuka Anamnesis dari workspace Pelayanan Pasien
        // menampilkan catatan SELURUH pasien — petugas harus mencari sendiri
        // milik pasien yang sedang dilayani, dan mudah salah baca.
        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        return AnamnesisResource::collection($query->latest()->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreAnamnesisRequest $request)
    {
        $data = $request->validated();
        $data = $this->fillActingEmployee($request, $data, 'recorded_by');
        // Cegah penulisan ke rekam medis yang sudah difinalkan.
        $this->guardMedicalRecord($request, $data);

        $record = Anamnesis::create($data);

        return (new AnamnesisResource($record))->response()->setStatusCode(201);
    }

    public function show(Anamnesis $record): AnamnesisResource
    {
        return new AnamnesisResource($record);
    }

    public function update(UpdateAnamnesisRequest $request, Anamnesis $record): AnamnesisResource
    {
        $record->update($request->validated());

        return new AnamnesisResource($record);
    }

    public function destroy(Anamnesis $record)
    {
        $record->delete();

        return response()->json(null, 204);
    }
}
