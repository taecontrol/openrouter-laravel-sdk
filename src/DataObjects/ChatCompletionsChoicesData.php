<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Taecontrol\OpenRouter\Enums\Role;

class ChatCompletionsChoicesData implements Arrayable
{
    public function __construct(
        public Role $role,
        public int $content,
        public ?string $refusal = null,
    ) {}

    public static function from(array $data): self
    {
        return new self(
            role: Role::from(Arr::get($data, 'role')),
            content: Arr::get($data, 'content'),
            refusal: Arr::get($data, 'refusal')
        );
    }

    public function toArray(): array
    {
        return [
            'role' => $this->role->value,
            'content' => $this->content,
            'refusal' => $this->refusal,
        ];
    }
}
