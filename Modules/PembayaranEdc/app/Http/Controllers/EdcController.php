<?php

namespace Modules\PembayaranEdc\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\PembayaranEdc\Http\Requests\StoreEdcRequest;
use Modules\PembayaranEdc\Http\Requests\UpdateEdcRequest;
use Modules\PembayaranEdc\Http\Resources\EdcResource;
use Modules\PembayaranEdc\Models\Edc;
use Modules\PembayaranEdc\Services\EdcService;

class EdcController extends Controller
{
    public function index(Request $request)
    {
        $query = Edc::query();

        if ($request->filled('payment_id')) {
            $query->where('payment_id', $request->integer('payment_id'));
        }

        return EdcResource::collection($query->latest('transaction_at')->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEdcRequest $request, EdcService $service)
    {
        $edc = $service->create($request->validated());

        return (new EdcResource($edc))->response()->setStatusCode(201);
    }

    public function show(Edc $edc_transaction): EdcResource
    {
        return new EdcResource($edc_transaction);
    }

    public function update(UpdateEdcRequest $request, Edc $edc_transaction, EdcService $service): EdcResource
    {
        $data = $request->validated();

        return new EdcResource($service->transition($edc_transaction, $data['status'], $data));
    }
}
