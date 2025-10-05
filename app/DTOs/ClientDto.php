<?php

namespace App\DTOs;

use App\Models\Client;

class ClientDto
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $email,
        public ?string $phone,
        public ?string $address,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {}

    public static function fromModel(Client $c): self
    {
        return new self(
            id: $c->id,
            name: $c->name,
            email: $c->email,
            phone: $c->phone,
            address: $c->address,
            createdAt: optional($c->created_at)?->toISOString(),
            updatedAt: optional($c->updated_at)?->toISOString(),
        );
    }

    public static function fromArray(array $data, ?int $id = null): self
    {
        return new self(
            id: $id,
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'] ?? null,
            address: $data['address'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'email'     => $this->email,
            'phone'     => $this->phone,
            'address'   => $this->address,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
