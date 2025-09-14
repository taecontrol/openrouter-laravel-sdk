<?php

namespace Taecontrol\OpenRouter\DataObjects;

use Illuminate\Contracts\Support\Arrayable;

class ChatCompletionsData implements Arrayable
{
    public function __construct(
        public readonly string $model,
        /** @var ChatCompletionMessagesData[] */
        public readonly array $messages,
        public readonly ?ReasoningData $reasoningData = null,
        public readonly ?UsageData $usageData = null,
        public readonly ?int $maxTokens = null,
        public readonly ?float $temperature = null,
        public readonly ?int $seed = null,
        public readonly ?float $topP = null,
        public readonly ?int $topK = null,
        public readonly ?string $user = null,
    ) {}

    public function toArray(): array
    {
        return [
            'model' => $this->model,
            'messages' => $this->messages,
            'reasoning' => $this->reasoningData?->toArray(),
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
