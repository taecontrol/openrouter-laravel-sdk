<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Saloon\Traits\Responses\HasResponse;

class CompletionsResponse implements Arrayable
{
    use HasResponse;

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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'choices' => array_map(fn ($choice) => $choice->toArray(), $this->choices),
        ];
    }
}
