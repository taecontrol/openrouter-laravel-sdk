<?php

namespace Taecontrol\OpenRouter\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Taecontrol\OpenRouter\DataObjects\CompletionsData;

class CompletionsStreamRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(public readonly CompletionsData $data) {}

    public function resolveEndpoint(): string
    {
        return '/completions';
    }

    public function defaultBody(): array
    {
        $data = [
            'model' => $this->data->model,
            'prompt' => $this->data->prompt,
            'stream' => true,
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
