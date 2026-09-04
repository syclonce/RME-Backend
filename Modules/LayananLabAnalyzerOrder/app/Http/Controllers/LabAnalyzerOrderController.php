<?php

namespace Modules\LayananLabAnalyzerOrder\Http\Controllers;

use App\Http\Concerns\ResolvesActingEmployee;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Auth\Models\User;
use Modules\LayananLabAnalyzerOrder\Http\Requests\RecordLabAnalyzerOrderResultRequest;
use Modules\LayananLabAnalyzerOrder\Http\Requests\StoreLabAnalyzerOrderRequest;
use Modules\LayananLabAnalyzerOrder\Http\Requests\UpdateLabAnalyzerOrderRequest;
use Modules\LayananLabAnalyzerOrder\Http\Resources\LabAnalyzerOrderResource;
use Modules\LayananLabAnalyzerOrder\Models\LabAnalyzerOrder;
use Modules\LayananLabAnalyzerOrder\Services\LabAnalyzerOrderService;

class LabAnalyzerOrderController extends Controller
{
    use ResolvesActingEmployee;

    public function __construct(protected LabAnalyzerOrderService $service) {}

    public function index(Request $request): AnonymousResourceCollection
    {
        $query = LabAnalyzerOrder::query()
            ->with(['vendor:id,vendor_name', 'visit:id,visit_number,status']);

        if ($request->filled('visit_id')) {
            $query->where('visit_id', $request->integer('visit_id'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->string('status'));
        }

        return LabAnalyzerOrderResource::collection(
            $query->latest('ordered_at')->paginate($request->integer('per_page', 15)),
        );
    }

    public function store(StoreLabAnalyzerOrderRequest $request): JsonResponse
    {
        // Semua tulisan order lewat service: status 'ordered' tidak bisa disuntik klien.
        $order = $this->service->create($this->fillActingEmployee($request, $request->validated(), 'ordered_by'))->load('vendor');

        return (new LabAnalyzerOrderResource($order))->response()->setStatusCode(201);
    }

    public function show(LabAnalyzerOrder $lab_analyzer_order): LabAnalyzerOrderResource
    {
        return new LabAnalyzerOrderResource($lab_analyzer_order->load(['vendor', 'visit']));
    }

    public function update(UpdateLabAnalyzerOrderRequest $request, LabAnalyzerOrder $lab_analyzer_order): LabAnalyzerOrderResource
    {
        $order = $this->service->update($lab_analyzer_order->id, $request->validated());

        return new LabAnalyzerOrderResource($order);
    }

    public function destroy(LabAnalyzerOrder $lab_analyzer_order)
    {
        $this->service->destroy($lab_analyzer_order->id);

        return response()->noContent();
    }

    /** Transisi 1: kirim order ke analyzer (gerbang dari 'ordered'). */
    public function sendToAnalyzer(LabAnalyzerOrder $order): LabAnalyzerOrderResource
    {
        return new LabAnalyzerOrderResource($this->service->sendToAnalyzer($order->id));
    }

    /** Transisi 2: terima hasil mentah dari analyzer (gerbang dari 'sent_to_analyzer'). */
    public function recordResult(RecordLabAnalyzerOrderResultRequest $request, LabAnalyzerOrder $order): LabAnalyzerOrderResource
    {
        return new LabAnalyzerOrderResource(
            $this->service->recordResult($order->id, $request->validated('raw_result_text')),
        );
    }

    /**
     * Gerbang verifikasi spesifikasi modul: hanya dari result_received,
     * verified_by diambil dari user yang sedang login (bukan dari body).
     */
    public function verify(Request $request, LabAnalyzerOrder $order): LabAnalyzerOrderResource
    {
        /** @var User $user */
        $user = $request->user();

        return new LabAnalyzerOrderResource($this->service->verify($order->id, $user));
    }
}
