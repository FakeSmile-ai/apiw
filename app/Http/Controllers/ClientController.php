<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Services\Interfaces\ClientServiceInterface;

class ClientController extends Controller
{
    public function __construct(private ClientServiceInterface $service) {}

    // GET /api/clients?q=...&per_page=...
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $q = $request->query('q'); // filtro libre

        $pager = $this->service->list($perPage, $q);
        return response()->json($pager);
    }

    // GET /api/clients/{id}
    public function show(int $id): JsonResponse
    {
        $dto = $this->service->get($id);
        return response()->json($dto->toArray());
    }

    // POST /api/clients
    public function store(StoreClientRequest $request): JsonResponse
    {
        $dto = $this->service->create($request->validated());
        return response()->json($dto->toArray(), 201);
    }

    // PUT/PATCH /api/clients/{id}
    public function update(UpdateClientRequest $request, int $id): JsonResponse
    {
        $dto = $this->service->update($id, $request->validated());
        return response()->json($dto->toArray());
    }

    // DELETE /api/clients/{id}
    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}
