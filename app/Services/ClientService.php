<?php

namespace App\Services;

use App\DTOs\ClientDto;
use App\Repositories\Interfaces\ClientRepositoryInterface;
use App\Services\Interfaces\ClientServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ClientService implements ClientServiceInterface
{
    public function __construct(private ClientRepositoryInterface $repo) {}

    public function list(int $perPage = 15, ?string $q = null): LengthAwarePaginator
    {
        $paginator = $this->repo->paginate($perPage, $q);
        $paginator->getCollection()->transform(
            fn ($client) => ClientDto::fromModel($client)->toArray()
        );
        return $paginator;
    }

    public function get(int $id): ClientDto
    {
        $c = $this->repo->findOrFail($id);
        return ClientDto::fromModel($c);
    }

    public function create(array $data): ClientDto
    {
        $c = $this->repo->create($data);
        return ClientDto::fromModel($c);
    }

    public function update(int $id, array $data): ClientDto
    {
        $c = $this->repo->findOrFail($id);
        $c = $this->repo->update($c, $data);
        return ClientDto::fromModel($c);
    }

    public function delete(int $id): void
    {
        $c = $this->repo->findOrFail($id);
        $this->repo->delete($c);
    }
}
