<?php

namespace Modules\GeneralBank\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralBank\Models\Bank;

class BankController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(Bank::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:banks,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:banks,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(Bank::create($data)->refresh(), 201);
    }

    public function show(Bank $bank): Bank
    {
        return $bank;
    }

    public function update(Request $request, Bank $bank): Bank
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('banks', 'name')->ignore($bank->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('banks', 'code')->ignore($bank->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $bank->update($data);

        return $bank;
    }

    public function destroy(Bank $bank)
    {
        $bank->delete();

        return response()->json(null, 204);
    }
}