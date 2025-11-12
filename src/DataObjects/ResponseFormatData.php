<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;
use InvalidArgumentException;
use Taecontrol\OpenRouter\Enums\ResponseFormat;

class ResponseFormatData implements Arrayable
{
    public function __construct(
        public ?ResponseFormat $type,

        // Only for type=json_schema
        public ?string $schemaName = null,
        public ?string $schemaDescription = null,
        public ?array $schema = null,
        public ?bool $strict = null,

        // Only for type=grammar
        public ?string $grammar = null,
    ) {}

    public static function text(): self
    {
        return new self(ResponseFormat::Text);
    }

    public static function jsonObject(): self
    {
        return new self(ResponseFormat::JsonObject);
    }

    public static function jsonSchema(string $name, array $schema = [], ?string $description = null, ?bool $strict = null): self
    {
        return new self(
            ResponseFormat::JsonSchema,
            schemaName: $name,
            schemaDescription: $description,
            schema: $schema,
            strict: $strict,
        );
    }

    public static function grammar(string $grammar): self
    {
        return new self(ResponseFormat::Grammar, grammar: $grammar);
    }

    public static function python(): self
    {
        return new self(ResponseFormat::Python);
    }

    public function toArray(): array
    {
        $payload = ['type' => $this->type?->value];

        if ($this->type === ResponseFormat::JsonSchema) {
            if ($this->schemaName === null || $this->schemaName === '') {
                throw new InvalidArgumentException('json_schema.name is required for ResponseFormat::JsonSchema');
            }

            if (mb_strlen($this->schemaName) > 64) {
                throw new InvalidArgumentException('json_schema.name must be <= 64 characters');
            }
            $jsonSchema = [
                'name' => $this->schemaName,
            ];

            if ($this->schemaDescription !== null) {
                $jsonSchema['description'] = $this->schemaDescription;
            }

            if (! empty($this->schema ?? [])) {
                $jsonSchema['schema'] = $this->schema;
            }

            if ($this->strict !== null) {
                $jsonSchema['strict'] = $this->strict;
            }

            $payload['json_schema'] = $jsonSchema;
        }

        if ($this->type === ResponseFormat::Grammar && $this->grammar !== null) {
            $payload['grammar'] = $this->grammar;
        }

        return $payload;
    }
}
