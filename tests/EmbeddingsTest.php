<?php

use Taecontrol\OpenRouter\DataObjects\EmbeddingObjectData;
use Taecontrol\OpenRouter\DataObjects\EmbeddingsData;
use Taecontrol\OpenRouter\DataObjects\EmbeddingsResponseData;
use Taecontrol\OpenRouter\DataObjects\UsageResponseData;
use Taecontrol\OpenRouter\Enums\EmbeddingEncodingFormat;

it('serializes embeddings request data', function () {
    $data = new EmbeddingsData(
        input: 'The quick brown fox jumps over the lazy dog',
        model: 'text-embedding-ada-002',
        encodingFormat: EmbeddingEncodingFormat::Float,
    );

    $array = $data->toArray();

    expect($array)->toBe([
        'input' => 'The quick brown fox jumps over the lazy dog',
        'model' => 'text-embedding-ada-002',
        'encoding_format' => 'float',
    ]);
});

it('deserializes embeddings response data', function () {
    $responseData = [
        'object' => 'list',
        'data' => [
            [
                'object' => 'embedding',
                'embedding' => [0.1, 0.2, 0.3],
                'index' => 0,
            ],
        ],
        'model' => 'text-embedding-ada-002',
        'usage' => [
            'prompt_tokens' => 5,
            'total_tokens' => 5,
        ],
    ];

    $response = EmbeddingsResponseData::from($responseData);

    expect($response->object)->toBe('list')
        ->and($response->model)->toBe('text-embedding-ada-002')
        ->and($response->data)->toHaveCount(1)
        ->and($response->data[0])->toBeInstanceOf(EmbeddingObjectData::class)
        ->and($response->data[0]->embedding)->toBe([0.1, 0.2, 0.3])
        ->and($response->usage)->toBeInstanceOf(UsageResponseData::class)
        ->and($response->usage->promptTokens)->toBe(5)
        ->and($response->usage->totalTokens)->toBe(5);
});

it('serializes embeddings response data to array', function () {
    $usage = new UsageResponseData(promptTokens: 5, completionTokens: 0, totalTokens: 5);
    $embeddingObject = new EmbeddingObjectData(object: 'embedding', embedding: [0.1, 0.2], index: 0);

    $response = new EmbeddingsResponseData(
        object: 'list',
        data: [$embeddingObject],
        model: 'text-embedding-ada-002',
        id: 'test-id',
        usage: $usage,
    );

    $array = $response->toArray();

    expect($array['usage'])->toBeArray()
        ->and($array['usage']['prompt_tokens'])->toBe(5);
});
