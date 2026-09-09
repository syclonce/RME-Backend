<?php

namespace Modules\GeneralVideoAttachment\Http\Controllers;

use App\Http\Concerns\SearchesListing;

use App\Http\Controllers\Controller;
use App\Http\Concerns\GuardsMedicalRecord;
use Illuminate\Http\Request;
use Modules\GeneralVideoAttachment\Http\Requests\StoreVideoAttachmentRequest;
use Modules\GeneralVideoAttachment\Http\Requests\UpdateVideoAttachmentRequest;
use Modules\GeneralVideoAttachment\Http\Resources\VideoAttachmentResource;
use Modules\GeneralVideoAttachment\Models\VideoAttachment;

class VideoAttachmentController extends Controller
{
    use SearchesListing;

    use GuardsMedicalRecord;

    public function index(Request $request)
    {
        $query = VideoAttachment::query();

        // Kotak pencarian di 563 halaman mengirim `?name=`; tanpa ini filternya
        // diabaikan diam-diam dan daftar tidak berubah saat petugas mengetik.
        $query = $this->applySearch($query, $request);

        return VideoAttachmentResource::collection($query->orderBy('id')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreVideoAttachmentRequest $request)
    {
        $data = $request->validated();
        $this->guardMedicalRecord($request, $data);

        $data['is_active'] = $data['is_active'] ?? true;
        $video_attachment = VideoAttachment::create($data);

        return (new VideoAttachmentResource($video_attachment))->response()->setStatusCode(201);
    }

    public function show(VideoAttachment $video_attachment): VideoAttachmentResource
    {
        return new VideoAttachmentResource($video_attachment);
    }

    public function update(UpdateVideoAttachmentRequest $request, VideoAttachment $video_attachment): VideoAttachmentResource
    {
        $video_attachment->update($request->validated());

        return new VideoAttachmentResource($video_attachment);
    }

    public function destroy(VideoAttachment $video_attachment)
    {
        $video_attachment->delete();

        return response()->json(null, 204);
    }
}
