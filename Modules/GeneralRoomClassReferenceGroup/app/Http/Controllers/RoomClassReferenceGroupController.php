<?php

namespace Modules\GeneralRoomClassReferenceGroup\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\GeneralRoomClassReferenceGroup\Models\RoomClassReferenceGroup;

class RoomClassReferenceGroupController extends Controller
{
    use SearchesListing;

    public function index(Request $request)
    {
        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch(RoomClassReferenceGroup::query(), $request);

        return $query->orderBy('name')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:room_class_reference_groups,name'],
            'code' => ['nullable', 'string', 'max:10', 'unique:room_class_reference_groups,code'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return response()->json(RoomClassReferenceGroup::create($data)->refresh(), 201);
    }

    public function show(RoomClassReferenceGroup $room_class_reference_group): RoomClassReferenceGroup
    {
        return $room_class_reference_group;
    }

    public function update(Request $request, RoomClassReferenceGroup $room_class_reference_group): RoomClassReferenceGroup
    {
        $data = $request->validate([
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('room_class_reference_groups', 'name')->ignore($room_class_reference_group->id)],
            'code' => ['nullable', 'string', 'max:10', Rule::unique('room_class_reference_groups', 'code')->ignore($room_class_reference_group->id)],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $room_class_reference_group->update($data);

        return $room_class_reference_group;
    }

    public function destroy(RoomClassReferenceGroup $room_class_reference_group)
    {
        $room_class_reference_group->delete();

        return response()->json(null, 204);
    }
}
