<?php

namespace Modules\MedicalRecordImageMarkerPoint\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalRecordImageMarkerPoint\Http\Requests\StoreImageMarkerPointRequest;
use Modules\MedicalRecordImageMarkerPoint\Http\Requests\UpdateImageMarkerPointRequest;
use Modules\MedicalRecordImageMarkerPoint\Http\Resources\ImageMarkerPointResource;
use Modules\MedicalRecordImageMarkerPoint\Models\ImageMarkerPoint;
use App\Http\Concerns\GuardsMedicalRecord;
use App\Observers\MedicalRecordMutationGuard;

class ImageMarkerPointController extends Controller
{
    use GuardsMedicalRecord;

    use SearchesListing;

    public function index(Request $request)
    {
        $query = ImageMarkerPoint::query();

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini
        // filternya diabaikan diam-diam saat petugas mengetik.
        $query = $this->applySearch($query, $request);


        if ($request->filled('image_marker_id')) {
            $query->where('image_marker_id', $request->integer('image_marker_id'));
        }

        return ImageMarkerPointResource::collection(
            $query->latest()->paginate($request->integer('per_page', 15))
        );
    }

    public function store(StoreImageMarkerPointRequest $request)
    {
        $data = $request->validated();

        $record = ImageMarkerPoint::create($data);

        return (new ImageMarkerPointResource($record))->response()->setStatusCode(201);
    }

    public function show(ImageMarkerPoint $record): ImageMarkerPointResource
    {
        return new ImageMarkerPointResource($record);
    }

    public function update(UpdateImageMarkerPointRequest $request, ImageMarkerPoint $record): ImageMarkerPointResource
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->update($request->validated());

        return new ImageMarkerPointResource($record);
    }

    public function destroy(Request $request, ImageMarkerPoint $record)
    {
        $this->guardMedicalRecord($request, ['visit_id' => MedicalRecordMutationGuard::resolveVisitId($record)]);

        $record->delete();

        return response()->noContent();
    }
}
