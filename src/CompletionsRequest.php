<?php

namespace Taecontrol\OpenRouter;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Taecontrol\OpenRouter\DataObjects\ReasoningData;
use Taecontrol\OpenRouter\DataObjects\UsageData;

class CompletionsRequest extends Request
{
    protected Method $method = Method::POST;

    public function __construct(
        protected readonly string $model,
        protected readonly string $prompt,
        protected readonly ?ReasoningData $reasoningData = null,
        protected readonly ?UsageData $usageData = null,
        protected readonly ?int $maxTokens = null,
        protected readonly ?float $temperature = null,
        protected readonly ?int $seed = null,
        protected readonly ?float $topP = null,
        protected readonly ?int $topK = null,
        protected readonly ?string $user = null,
    ) {}

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
            'model' => $this->model,
            'prompt' => $this->prompt,
        ];

        if ($this->reasoningData) {
            $data['reasoning'] = $this->reasoningData->toArray();
        }

        if ($this->usageData) {
            $data['usage'] = $this->usageData->toArray();
        }

        if ($this->maxTokens !== null) {
            $data['max_tokens'] = $this->maxTokens;
        }

        if ($this->temperature !== null) {
            $data['temperature'] = $this->temperature;
        }

        if ($this->seed !== null) {
            $data['seed'] = $this->seed;
        }

        if ($this->topP !== null) {
            $data['top_p'] = $this->topP;
        }

        if ($this->topK !== null) {
            $data['top_k'] = $this->topK;
        }

        if ($this->user !== null) {
            $data['user'] = $this->user;
        }

        return $data;
    }
}