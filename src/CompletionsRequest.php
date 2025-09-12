<?php

namespace Taecontrol\OpenRouter;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Taecontrol\OpenRouter\DataObjects\CompletionsData;

class CompletionsRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(public readonly CompletionsData $data) {}

    public function resolveEndpoint(): string
    {
        return '/completions';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    public function defaultBody(): array
    {
        $data = [
            'model' => $this->data->model,
            'prompt' => $this->data->prompt,
        ];

        if ($this->data->reasoningData) {
            $data['reasoning'] = $this->data->reasoningData->toArray();
        }

        if ($this->data->usageData) {
            $data['usage'] = $this->data->usageData->toArray();
        }

        if ($this->data->maxTokens !== null) {
            $data['max_tokens'] = $this->data->maxTokens;
        }

        if ($this->data->temperature !== null) {
            $data['temperature'] = $this->data->temperature;
        }

        if ($this->data->seed !== null) {
            $data['seed'] = $this->data->seed;
        }

        if ($this->data->topP !== null) {
            $data['top_p'] = $this->data->topP;
        }

        if ($this->data->topK !== null) {
            $data['top_k'] = $this->data->topK;
        }

        if ($this->data->user !== null) {
            $data['user'] = $this->data->user;
        }

        return $data;
    }
}
