<?php

namespace App\DTOs\Api\V1;

readonly class CancelRequestDto
{
    public function __construct(
        public string $action,
        public int $activation,
        public string $token,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            action: $data['action'],
            activation: $data['activation'],
            token: $data['token'],
        );
    }

    public function toArray(): array
    {
        return [
            'action' => $this->action,
            'activation' => $this->activation,
            'token' => $this->token,
        ];
    }
}
