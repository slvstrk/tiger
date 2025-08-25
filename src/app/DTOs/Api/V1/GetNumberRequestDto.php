<?php

namespace App\DTOs\Api\V1;

readonly class GetNumberRequestDto
{
    public function __construct(
        public string $action,
        public string $country,
        public string $service,
        public string $token,
        public ?int $rent_time = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            action: $data['action'],
            country: $data['country'],
            service: $data['service'],
            token: $data['token'],
            rent_time: $data['rent_time'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'action' => $this->action,
            'country' => $this->country,
            'service' => $this->service,
            'token' => $this->token,
            'rent_time' => $this->rent_time,
        ], fn($value) => $value !== null);
    }
}

