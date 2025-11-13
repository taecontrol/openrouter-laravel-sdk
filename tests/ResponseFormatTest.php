<?php

use Taecontrol\OpenRouter\DataObjects\ChatCompletionsData;
use Taecontrol\OpenRouter\DataObjects\ChatCompletionsMessageData;
use Taecontrol\OpenRouter\DataObjects\CompletionsData;
use Taecontrol\OpenRouter\DataObjects\ResponseFormatData;
use Taecontrol\OpenRouter\Enums\Role;

it('serializes response_format json_object for chat', function () {
    $msg = new ChatCompletionsMessageData(role: Role::User, content: 'Hi');
    $data = new ChatCompletionsData(
        model: 'gpt-test',
        messages: [$msg->toArray()],
        responseFormat: ResponseFormatData::jsonObject(),
    );

    $array = $data->toArray();

    expect($array['response_format'])
        ->toBe(['type' => 'json_object']);
});

it('serializes response_format json_schema for completions', function () {
    $schema = [
        'type' => 'object',
        'properties' => [
            'name' => ['type' => 'string'],
        ],
        'required' => ['name'],
        'additionalProperties' => false,
    ];

    $data = new CompletionsData(
        model: 'gpt-test',
        prompt: 'Say hello',
        responseFormat: ResponseFormatData::jsonSchema(name: 'person', schema: $schema, description: 'Person schema', strict: true),
    );

    $array = $data->toArray();

    expect($array['response_format'])
        ->toBe([
            'type' => 'json_schema',
            'json_schema' => [
                'name' => 'person',
                'description' => 'Person schema',
                'schema' => $schema,
                'strict' => true,
            ],
        ]);
});
