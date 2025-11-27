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
    ) {
    }

    public static function from(array $data): self
    {
        $choices = array_map(
            fn ($choice) => ChatCompletionsChoiceData::from($choice),
            Arr::get($data, 'choices', [])
        );

        $usageData = Arr::get($data, 'usage');

        return new self(
            id: Arr::get($data, 'id'),
            choices: $choices,
            provider: Arr::get($data, 'provider'),
            model: Arr::get($data, 'model'),
            object: Arr::get($data, 'object'),
            created: Arr::get($data, 'created'),
            usage: $usageData ? UsageResponseData::from($usageData) : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'choices' => array_map(fn ($choice) => $choice->toArray(), $this->choices),
            'provider' => $this->provider,
            'model' => $this->model,
            'object' => $this->object,
            'created' => $this->created,
            'usage' => $this->usage?->toArray(),
        ], fn ($value) => !is_null($value));
    }
}
