<?php

namespace Modules\GeneralBed\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Contracts\WardScope;
use Illuminate\Http\Request;
use Modules\GeneralBed\Models\Bed;
use Modules\GeneralBed\Services\BedService;
use Modules\GeneralRoom\Models\Room;

class BedController extends Controller
{
    public function __construct(protected BedService $bedService, protected WardScope $wardScope)
    {
    }

    public function index(Request $request)
    {
        $query = Bed::query()->with('room');

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->integer('room_id'));
        }

        if ($request->filled('ward_id')) {
            $query->whereHas('room', fn ($q) => $q->where('ward_id', $request->integer('ward_id')));
        }

        if ($request->boolean('available_only')) {
            $query->where('is_active', true)->where('status', Bed::STATUS_AVAILABLE);
        }

        // Baca juga di-scope ward (#3): sama seperti gerbang tulis.
        $user = $request->user();
        if (! $user->hasRole('admin')) {
            $assigned = $this->wardScope->assignedWardIds($user->id);
            if ($assigned !== []) {
                $query->whereHas('room', fn ($q) => $q->whereIn('ward_id', $assigned));
            }
        }

        return $query->orderBy('bed_number')->paginate(min(max($request->integer('per_page', 15), 1), 100));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_id' => ['required', 'integer', 'exists:rooms,id'],
            'bed_number' => ['required', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $wardId = Room::query()->whereKey($data['room_id'])->value('ward_id');
        abort_if(
            ! $this->wardScope->canAccessWard($request->user(), $wardId),
            403,
            'Anda tidak ditugaskan ke ward room ini.',
        );

        return response()->json(Bed::create($data)->refresh(), 201);
    }

    public function show(Request $request, Bed $bed): Bed
    {
        abort_if(
            ! $this->wardScope->canAccessWard($request->user(), $bed->room?->ward_id),
            403,
            'Anda tidak ditugaskan ke ward bed ini.',
        );

        return $bed;
    }

    public function update(Request $request, Bed $bed): Bed
    {
        $data = $request->validate([
            'bed_number' => ['sometimes', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        return $this->bedService->updateDetails($bed->id, $data, $request->user());
    }

    public function destroy(Request $request, Bed $bed)
    {
        $this->bedService->deleteBed($bed->id, $request->user());

        return response()->json(null, 204);
    }

    public function reserve(Request $request, Bed $bed)
    {
        abort_if(
            ! $this->wardScope->canAccessWard($request->user(), $bed->room?->ward_id),
            403,
            'Anda tidak ditugaskan ke ward bed ini.',
        );

        $this->bedService->reserve($bed->id);

        return $bed->refresh();
    }

    public function releaseReservation(Request $request, Bed $bed)
    {
        abort_if(
            ! $this->wardScope->canAccessWard($request->user(), $bed->room?->ward_id),
            403,
            'Anda tidak ditugaskan ke ward bed ini.',
        );

        $this->bedService->releaseReservation($bed->id);

        return $bed->refresh();
    }
}
