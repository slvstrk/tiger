<?php

namespace App\DTOs\Api\V1;

class GetSmsRequestDto
{
    public function __construct(
        public string $action,
        public string $token,
        public int $activation,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            action: $data['action'],
            token: $data['token'],
            activation: $data['activation'],
        );
    }

    public function toArray(): array
    {
        return [
            'action' => $this->action,
            'token' => $this->token,
            'activation' => $this->activation,
        ];
    }
}
