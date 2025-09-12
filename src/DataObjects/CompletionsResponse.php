<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Support\Arr;

class CompletionsResponse
{
    public function __construct(
        public string $id,
        /** @var CompletionsChoicesData[] */
        public array $choices = [],
    ) {}

    public static function from(array $data): self
    {
        $choices = array_map(
            fn ($choice) => CompletionsChoicesData::from($choice),
            Arr::get($data, 'choices', [])
        );

        return new self(
            id: Arr::get($data, 'id'),
            choices: $choices,
        );
    }
}
