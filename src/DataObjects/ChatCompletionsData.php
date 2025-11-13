<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;

readonly class ChatCompletionsData implements Arrayable
{
    public function __construct(
        public string $model,
        /** @var ChatCompletionsMessageData[] */
        public array $messages,
        /** @var list<mixed> */
        public array $tools = [],
        public ?ReasoningData $reasoningData = null,
        public ?ResponseFormatData $responseFormat = null,
        public ?UsageData $usageData = null,
        public ?int $maxTokens = null,
        public ?float $temperature = null,
        public ?int $seed = null,
        public ?float $topP = null,
        public ?int $topK = null,
        public ?string $user = null,
    ) {}

    public function toArray(): array
    {
        return [
            'model' => $this->model,
            'messages' => $this->messages,
            'tools' => $this->tools,
            'reasoning' => $this->reasoningData?->toArray(),
            'response_format' => $this->responseFormat?->toArray(),
            'usage' => $this->usageData?->toArray(),
            'max_tokens' => $this->maxTokens,
            'temperature' => $this->temperature,
            'seed' => $this->seed,
            'top_p' => $this->topP,
            'top_k' => $this->topK,
            'user' => $this->user,
        ];
    }
}
