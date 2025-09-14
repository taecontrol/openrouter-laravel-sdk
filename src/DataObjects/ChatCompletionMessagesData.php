<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Taecontrol\OpenRouter\Enums\Role;

class ChatCompletionMessagesData implements Arrayable
{
    public function __construct(
        public Role $role,
        public string $content,
    ) {}

    public static function from(array $data): self
    {
        return new self(
            role: Arr::get($data, 'role'),
            content: Arr::get($data, 'content'),
        );
    }

    public function toArray(): array
    {
        return [
            'role' => $this->role,
            'content' => $this->content,
        ];
    }
}
