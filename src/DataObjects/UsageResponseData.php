<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class UsageResponseData implements Arrayable
{
    public function __construct(
        public int $promptTokens,
        public int $completionTokens,
        public int $totalTokens,
    ) {}

    public static function from(array $data): self
    {
        return new self(
            promptTokens: Arr::get($data, 'prompt_tokens', 0),
            completionTokens: Arr::get($data, 'completion_tokens', 0),
            totalTokens: Arr::get($data, 'total_tokens', 0),
        );
    }

    public function toArray(): array
    {
        return [
            'prompt_tokens' => $this->promptTokens,
            'completion_tokens' => $this->completionTokens,
            'total_tokens' => $this->totalTokens,
        ];
    }
}
