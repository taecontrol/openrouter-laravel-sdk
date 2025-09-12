<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Taecontrol\OpenRouter\DataObjects\Enums\Effort;

class ReasoningData implements Arrayable
{
    public function __construct(
        public ?Effort $effort,
        public ?string $maxTokens,
        public ?bool $exclude,
    ) {}

    public function toArray(): array
    {
        return [
            'effort' => $this->effort?->value,
            'max_tokens' => $this->maxTokens,
            'exclude' => $this->exclude,
        ];
    }
}
