<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use Saloon\Traits\Responses\HasResponse;

class ChatCompletionsResponse implements Arrayable
{
    use HasResponse;

    public function __construct(
        public string $id,
        /** @var ChatCompletionsChoiceData[] */
        public array $choices = [],
        public ?string $provider = null,
        public ?string $model = null,
        public ?string $object = null,
        public ?int $created = null,
        public ?UsageResponseData $usage = null,
    ) {}

    public static function from(array $data): self
    {
        $choices = array_map(
            fn ($choice) => ChatCompletionsChoiceData::from($choice),
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
