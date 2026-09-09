<?php

namespace Modules\GeneralContactType\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralContactType\Models\ContactType;

class ContactTypeController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(ContactType::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:contact_types,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:contact_types,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(ContactType::create($data)->refresh(), 201);
    }

    public function show(ContactType $contactType): ContactType
    {
        return $contactType;
    }

    public function update(Request $request, ContactType $contactType): ContactType
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('contact_types', 'name')->ignore($contactType->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('contact_types', 'code')->ignore($contactType->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $contactType->update($data);

        return $contactType;
    }

    public function destroy(ContactType $contactType)
    {
        $contactType->delete();

        return response()->json(null, 204);
    }
}