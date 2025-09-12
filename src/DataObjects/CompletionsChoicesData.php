<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Support\Arr;

class CompletionsChoicesData
{
    public function __construct(
        public ?string $text = null,
        public ?int $index = null,
        public ?string $finishReason = null,
    ) {}

    public static function from(array $data): self
    {
        return new self(
            text: Arr::get($data, 'text'),
            index: Arr::get($data, 'index'),
            finishReason: Arr::get($data, 'finish_reason')
        );
    }
}
