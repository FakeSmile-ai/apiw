<?php

namespace App\Services\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\DTOs\ClientDto;

interface ClientServiceInterface
{
    public function list(int $perPage = 15, ?string $q = null): LengthAwarePaginator;
    public function get(int $id): ClientDto;
    public function create(array $data): ClientDto;
    public function update(int $id, array $data): ClientDto;
    public function delete(int $id): void;
}
