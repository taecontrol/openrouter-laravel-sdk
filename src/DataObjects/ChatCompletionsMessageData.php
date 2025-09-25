<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Taecontrol\OpenRouter\Enums\Role;

class ChatCompletionsMessageData implements Arrayable
{
    public function __construct(
        public Role $role,
        public string $content,
        public ?string $refusal = null,
        public ?string $reasoning = null,
        public array $reasoningDetails = [],
        public array $toolCalls = [],
    ) {}

    public static function from(array $data): self
    {
        $role = Arr::get($data, 'role') instanceof Role
            ? Arr::get($data, 'role')
            : Role::from(Arr::get($data, 'role'));

        return new self(
            role: $role,
            content: Arr::get($data, 'content'),
            refusal: Arr::get($data, 'refusal'),
            reasoning: Arr::get($data, 'reasoning'),
            reasoningDetails: Arr::get($data, 'reasoning_details', []),
            toolCalls: Arr::get($data, 'tool_calls', []),
        );
    }

    public function toArray(): array
    {
        return [
            'role' => $this->role,
            'content' => $this->content,
            'refusal' => $this->refusal,
            'reasoning' => $this->reasoning,
            'reasoning_details' => $this->reasoningDetails,
            'tool_calls' => $this->toolCalls,
        ];
    }
}
