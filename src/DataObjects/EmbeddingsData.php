<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use Taecontrol\OpenRouter\Enums\EmbeddingEncodingFormat;

readonly class EmbeddingsData implements Arrayable
{
    public function __construct(
        public string|array $input,
        public string $model,
        public ?EmbeddingEncodingFormat $encodingFormat = null,
        public ?int $dimensions = null,
        public ?string $user = null,
        public ?array $provider = null,
        public ?string $inputType = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'input' => $this->input,
            'model' => $this->model,
            'encoding_format' => $this->encodingFormat?->value,
            'dimensions' => $this->dimensions,
            'user' => $this->user,
            'provider' => $this->provider,
            'input_type' => $this->inputType,
        ], fn ($value) => ! is_null($value));
    }
}
