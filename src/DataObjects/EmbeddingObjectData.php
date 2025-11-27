<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class EmbeddingObjectData implements Arrayable
{
    public function __construct(
        public string $object,
        public array $embedding,
        public int $index,
    ) {
    }

    public static function from(array $data): self
    {
        return new self(
            object: Arr::get($data, 'object'),
            embedding: Arr::get($data, 'embedding'),
            index: Arr::get($data, 'index'),
        );
    }

    public function toArray(): array
    {
        return [
            'object' => $this->object,
            'embedding' => $this->embedding,
            'index' => $this->index,
        ];
    }
}
