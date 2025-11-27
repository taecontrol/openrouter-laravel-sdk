<?php

use Taecontrol\OpenRouter\DataObjects\ChatCompletionsChoiceData;
use Taecontrol\OpenRouter\DataObjects\ChatCompletionsResponse;
use Taecontrol\OpenRouter\DataObjects\UsageResponseData;

it('deserializes chat completions response data', function () {
    $responseData = [
        'id' => 'gen-123',
        'choices' => [
            [
                'index' => 0,
                'message' => [
                    'role' => 'assistant',
                    'content' => 'Hello there!',
                ],
                'finish_reason' => 'stop',
            ],
        ],
        'model' => 'gpt-3.5-turbo',
        'object' => 'chat.completion',
        'created' => 1677652288,
        'usage' => [
            'prompt_tokens' => 9,
            'completion_tokens' => 12,
            'total_tokens' => 21,
        ],
    ];

    $response = ChatCompletionsResponse::from($responseData);

    expect($response->id)->toBe('gen-123')
        ->and($response->model)->toBe('gpt-3.5-turbo')
        ->and($response->object)->toBe('chat.completion')
        ->and($response->created)->toBe(1677652288)
        ->and($response->choices)->toHaveCount(1)
        ->and($response->choices[0])->toBeInstanceOf(ChatCompletionsChoiceData::class)
        ->and($response->usage)->toBeInstanceOf(UsageResponseData::class)
        ->and($response->usage->promptTokens)->toBe(9)
        ->and($response->usage->totalTokens)->toBe(21);
});
