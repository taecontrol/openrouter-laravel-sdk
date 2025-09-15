<?php

namespace Taecontrol\OpenRouter\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Taecontrol\OpenRouter\DataObjects\ChatCompletionsData;

class ChatCompletionsStreamRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(public readonly ChatCompletionsData $data) {}

    public function resolveEndpoint(): string
    {
        return '/chat/completions';
    }

    public function defaultBody(): array
    {
        $data = [
            'model' => $this->data->model,
            'messages' => $this->data->messages,
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
