<?php

namespace App\Repositories\Eloquent;

use App\Models\Client;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\Interfaces\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    public function paginate(int $perPage = 15, ?string $q = null): LengthAwarePaginator
    {
        return Client::query()
            ->when($q, function ($query) use ($q) {
                $like = "%{$q}%";
                $query->where(function ($w) use ($like) {
                    $w->where('name','like',$like)
                      ->orWhere('email','like',$like)
                      ->orWhere('phone','like',$like)
                      ->orWhere('address','like',$like);
                });
            })
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function findOrFail(int $id): Client
    {
        return Client::findOrFail($id);
    }

    public function create(array $data): Client
    {
        return Client::create($data);
    }

    public function update(Client $client, array $data): Client
    {
        $client->fill($data)->save();
        return $client;
    }

    public function delete(Client $client): void
    {
        $client->delete();
    }
}
