<?php

namespace Modules\GeneralDosageInstruction\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralDosageInstruction\Models\DosageInstruction;

class DosageInstructionController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return DosageInstruction::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:dosage_instructions,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:dosage_instructions,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(DosageInstruction::create($data)->refresh(), 201);
    }

    public function show(DosageInstruction $dosageInstruction): DosageInstruction
    {
        return $dosageInstruction;
    }

    public function update(Request $request, DosageInstruction $dosageInstruction): DosageInstruction
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('dosage_instructions', 'name')->ignore($dosageInstruction->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('dosage_instructions', 'code')->ignore($dosageInstruction->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $dosageInstruction->update($data);

        return $dosageInstruction;
    }

    public function destroy(DosageInstruction $dosageInstruction)
    {
        $dosageInstruction->delete();

        return response()->json(null, 204);
    }
}