<?php

namespace Modules\GeneralMixtureInstruction\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralMixtureInstruction\Models\MixtureInstruction;

class MixtureInstructionController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return MixtureInstruction::query()->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:mixture_instructions,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:mixture_instructions,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(MixtureInstruction::create($data)->refresh(), 201);
    }

    public function show(MixtureInstruction $mixtureInstruction): MixtureInstruction
    {
        return $mixtureInstruction;
    }

    public function update(Request $request, MixtureInstruction $mixtureInstruction): MixtureInstruction
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('mixture_instructions', 'name')->ignore($mixtureInstruction->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('mixture_instructions', 'code')->ignore($mixtureInstruction->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $mixtureInstruction->update($data);

        return $mixtureInstruction;
    }

    public function destroy(MixtureInstruction $mixtureInstruction)
    {
        $mixtureInstruction->delete();

        return response()->json(null, 204);
    }
}