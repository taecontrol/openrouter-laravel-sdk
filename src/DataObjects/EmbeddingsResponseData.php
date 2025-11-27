<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Support\Arr;
use Saloon\Traits\Responses\HasResponse;
use Illuminate\Contracts\Support\Arrayable;
use Taecontrol\OpenRouter\DataObjects\UsageResponseData;

class EmbeddingsResponseData implements Arrayable
{
    use HasResponse;

    public function __construct(
        public string $object,
        /** @var EmbeddingObjectData[] */
        public array $data,
        public string $model,
        public ?string $id = null,
        public ?UsageResponseData $usage = null,
    ) {
    }

    public static function from(array $data): self
    {
        $embeddingObjects = array_map(
            fn ($item) => EmbeddingObjectData::from($item),
            Arr::get($data, 'data', [])
        );

        $usageData = Arr::get($data, 'usage');

        return new self(
            object: Arr::get($data, 'object'),
            data: $embeddingObjects,
            model: Arr::get($data, 'model'),
            id: Arr::get($data, 'id'),
            usage: $usageData ? UsageResponseData::from($usageData) : null,
        );
    }

    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'data' => array_map(fn ($item) => $item->toArray(), $this->data),
            'model' => $this->model,
            'id' => $this->id,
            'usage' => $this->usage?->toArray(),
        ];
    }
}
